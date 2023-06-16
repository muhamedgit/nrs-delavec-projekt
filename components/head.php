<?php
session_start();
// Večdimenzionalni asociativni array, ki vsebuje meni s sekcijami in povezavami
$menus = [
    'DELAVEC' => [
        'Vstavi podatke' => '/components/delavec/delavec_vstavi.php',
        'Izpiši podatke' => '/components/delavec/delavec_izpisi.php',
        'Izbriši podatke' => '/components/delavec/delavec_brisi.php',
        'Spremeni podatke' => '/components/delavec/delavec_spremeni.php'
    ],
    'PODJETJE' => [
        'Vstavi podatke' => '/components/podjetje/podjetje_vstavi.php',
        'Izpiši podatke' => '/components/podjetje/podjetje_izpisi.php',
        'Izbriši podatke' => '/components/podjetje/podjetje_brisi.php',
        'Spremeni podatke' => '/components/podjetje/podjetje_spremeni.php'
    ],
    'PROJEKT' => [
        'Vstavi podatke' => '/components/projekt/projekt_vstavi.php',
        'Izpiši podatke' => '/components/projekt/projekt_izpisi.php',
        'Izbriši podatke' => '/components/projekt/projekt_brisi.php',
        'Spremeni podatke' => '/components/projekt/projekt_spremeni.php'
    ],
    'SODELUJE' => [
        'Vstavi podatke' => '/components/sodeluje/sodeluje_vstavi.php',
        'Izpiši podatke' => '/components/sodeluje/sodeluje_izpisi.php',
        'Izbriši podatke' => '/components/sodeluje/sodeluje_brisi.php',
        'Spremeni podatke' => '/components/sodeluje/sodeluje_spremeni.php'
    ]
];

// Preveri, ali je aktivna sekcija že nastavljena v seji, sicer nastavi privzeto vrednost na 'DELAVEC'.
$activeSection = isset($_SESSION['active_section']) ? $_SESSION['active_section'] : 'DELAVEC';

// Posodobi aktivno sekcijo glede na poslane podatke iz obrazca
if (isset($_GET['section']) && array_key_exists($_GET['section'], $menus)) {
    $activeSection = $_GET['section'];
    $_SESSION['active_section'] = $activeSection;
}

?>

<!-- HTML del za prikaz menija in uporabniških informacij -->
<h1 class="naslov">Seminarska Naloga Delavec Projekt NRSp</h1>
<div class="loginContainer">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
        <!-- Prikaz uporabniških informacij, če je uporabnik prijavljen -->
        <div class="userInfo">
            <?php echo 'Prijavljen kot: ' . $_SESSION['email']; ?>
            <?php if (isset($_COOKIE['login_email'])) { ?>
                (Piškotek: <?php echo $_COOKIE['login_email']; ?>)
            <?php } ?>
        </div>
        <!-- Obrazec za odjavo -->
        <form action="/components/Login/logout.php" method="post">
            <input type="submit" value="Odjava">
        </form>
    <?php } else { ?>
        <!-- Prikaz povezave za prijavo, če uporabnik ni prijavljen -->
        <a href="/components/Login/login.php">Prijava</a>
    <?php } ?>
</div>

<!-- HTML del za prikaz menijske izbire -->

<div class="menuSelection">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <!-- Gumbi za izbiro sekcije menija -->
        <button class="a <?php echo ($activeSection === 'DELAVEC') ? 'active' : ''; ?>" type="submit" name="section" value="DELAVEC">DELAVEC</button>
        <button class="b <?php echo ($activeSection === 'PODJETJE') ? 'active' : ''; ?>" type="submit" name="section" value="PODJETJE">PODJETJE</button>
        <button class="a <?php echo ($activeSection === 'PROJEKT') ? 'active' : ''; ?>" type="submit" name="section" value="PROJEKT">PROJEKT</button>
        <button class="b <?php echo ($activeSection === 'SODELUJE') ? 'active' : ''; ?>" type="submit" name="section" value="SODELUJE">SODELUJE</button>
    </form>
    <!-- Povezava na domačo stran -->
    <a class="homeLink" href="/index.php">Domov</a>
</div>

<!-- HTML del za prikaz menija z navigacijskimi povezavami -->

<div class="menuContainer">
    <div class="navContainer">
        <div class="heading">
            <!-- Izpis trenutno aktivne sekcije -->
            <h1><?php echo $activeSection; ?></h1>
        </div>
        <nav class="navMenu">
    <?php foreach ($menus[$activeSection] as $menuItem => $menuItemLink) { ?>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
            <?php if ($menuItem === 'Izbriši podatke' || $menuItem === 'Spremeni podatke' || $menuItem === 'Vstavi podatke') { ?>
                <!-- Prikaz povezav za brisanje, spreminjanje in vnašanje podatkov, če je uporabnik prijavljen -->
                <a class="<?php echo ($activeSection === $menuItem) ? 'active' : ''; ?>" href="<?php echo $menuItemLink; ?>"><?php echo $menuItem; ?></a>
            <?php } else { ?>
                <!-- Prikaz ostalih povezav, če je uporabnik prijavljen -->
                <a class="<?php echo ($activeSection === $menuItem) ? 'active' : ''; ?>" href="<?php echo $menuItemLink; ?>"><?php echo $menuItem; ?></a>
            <?php } ?>
        <?php } else { ?>
            <?php if ($menuItem === 'Izpiši podatke') { ?>
                <!-- Prikaz povezave za izpis podatkov, če uporabnik ni prijavljen -->
                <a class="<?php echo ($activeSection === $menuItem) ? 'active' : ''; ?>" href="<?php echo $menuItemLink; ?>"><?php echo $menuItem; ?></a>
            <?php } else { ?>
                <!-- Prikaz onemogočenih povezav, če uporabnik ni prijavljen -->
                <a class="disabled" href="/components/Login/login.php"><?php echo $menuItem; ?></a>
            <?php } ?>
        <?php } ?>
    <?php } ?>
</nav>

    </div>
</div>


    </div>
</div>
