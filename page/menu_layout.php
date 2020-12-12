<link rel="stylesheet" href="../css/layout.css">

<!-- Header Bar -->
<div class="bar">
    <div class="burger" id="COmenu">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- <button class="btn btn-sm btn-danger btn-logout">Sign out</button> -->
    <div class="dropdown profile d-none d-md-block">
        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <?php echo $_SESSION['USERNAME'] ?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a id="logout" class="dropdown-item" href="">Sign out</a>
        </div>
    </div>
</div>

<!-- Side Menu -->
<div class="side-menu">
    <div class="logo">
        <img src="https://fph.tu.ac.th/uploads/fph/DownloadLogo/2018_FPHHorz%20Logo%20%28EN%29.png" alt="">
    </div>
    <div class="menu-content">
        <a href="lists.php" class="menu active">รายการพัสดุ</a>
        <a href="" class="menu">Dashboard 2</a>
    </div>
    <div class="dropup m-profile d-none d-md-none">
        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Name
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="">Sign out</a>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $('#COmenu').on('click', function(){
        $('body').toggleClass('no-scroll');
        $(this).toggleClass('active');
        $('.side-menu, .overlay').toggleClass('active');
        $('.m-profile').toggleClass('d-none');
        $('.m-profile').toggleClass('d-block');
    });

    $('.overlay').on('click', function(){
        $('body').toggleClass('no-scroll');
        $(this).toggleClass('active');
        $('.side-menu, #COmenu').toggleClass('active');
        $('.m-profile').toggleClass('d-none');
        $('.m-profile').toggleClass('d-block');
    });
    
    $(window).resize(function() {
        if($(window).width() > 992) {
            $('body').removeClass('no-scroll');
            $('#COmenu').removeClass('active');
            $('.side-menu, .overlay').removeClass('active');
            $('.m-profile').toggleClass('d-block');
            $('.m-profile').toggleClass('d-none');
        }
    });
</script>