<style>
    /*===== GOOGLE FONTS =====*/
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

/*===== VARIABLES CSS =====*/
:root{
  --nav-width: 92px;

  /*===== Colores =====*/
  --first-color: #0C5DF4;
  --bg-color: #12192C;
  --sub-color: #B6CEFC;
  --white-color: #FFF;
  
  /*===== Fuente y tipografia =====*/
  --body-font: 'Poppins', sans-serif;
  --normal-font-size: 1rem;
  --small-font-size: .875rem;
  
  /*===== z index =====*/
  --z-fixed: 100;
}
body{
  margin:0px 0px;
}
img{
  text-align:middle;
}
.top-nav{
    display:absolute;
    background-color:#0C5DF4;
    height:60px;
    width:100%;
    margin-top:0px;
}
.butto {
    display:absolute;
  border-radius: 8px;
  background-color: #12192C;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 18px;
  padding: 10px;
  width: 120px;
  transition: all 0.5s;
  cursor: pointer;
  margin-top: 11px;
  margin-right:40px;
  float:right;
}

.butto span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.butto span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.butto:hover span {
  padding-right: 25px;
}

.butto:hover span:after {
  opacity: 1;
  right: 0;
}

/*===== BASE =====*/
*,::before,::after{
  box-sizing: border-box;
}
body{
  position: relative;
  margin: 0;
  padding: 0rem 0 0 0rem;
  font-family: var(--body-font);
  font-size: var(--normal-font-size);
  transition: .5s;
}
h1{
  margin: 0;
}
ul{
  margin: 0;
  padding: 0;
  list-style: none;
}
a{
  text-decoration: none;
}

/*===== l NAV =====*/
.l-navbar{
  position: fixed;
  top: 0;
  left: 0;
  width: var(--nav-width);
  height: 100vh;
  background-color: var(--bg-color);
  color: var(--white-color);
  padding: 1.5rem 1.5rem 2rem;
  transition: .5s;
  z-index: var(--z-fixed);
}

/*===== NAV =====*/
.nav{
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  overflow: hidden;
}
.nav__brand{
  display: grid;
  grid-template-columns: max-content max-content;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}
.nav__toggle{
  font-size: 1.25rem;
  padding: .75rem;
  cursor: pointer;
}
.nav__logo{
  color: var(--white-color);
  font-weight: 600;
}

.nav__link{
  display: grid;
  grid-template-columns: max-content max-content;
  align-items: center;
  column-gap: .75rem;
  padding: .75rem;
  color: var(--white-color);
  border-radius: .5rem;
  margin-bottom: 1rem;
  transition: .3s;
  cursor: pointer;
}
.nav__link:hover{
  background-color: var(--first-color);
}
.nav__icon{
  font-size: 1.25rem;
}
.nav__name{
  font-size: var(--small-font-size);
}

/*Expander menu*/
.expander{
  width: calc(var(--nav-width) + 9.25rem);
}

/*Add padding body*/
.body-pd{
  padding: 0rem 0 0 10rem;
}

/*Active links menu*/
.active{
  background-color: var(--first-color);
}

/*===== COLLAPSE =====*/
.collapse{
  grid-template-columns: 20px max-content 1fr;
}
.collapse__link{
  justify-self: flex-end;
  transition: .5s;
}
.collapse__menu{
  display: none;
  padding: .75rem 2.25rem;
}
.collapse__sublink{
  color: var(--sub-color);
  font-size: var(--small-font-size);
}
.collapse__sublink:hover{
  color: var(--white-color);
}

/*Show collapse*/
.showCollapse{
  display: block;
}

/*Rotate icon*/
.rotate{
  transform: rotate(180deg);
}
.p{
  display:none;
  text-align:center;
  transition: .5s;

}
.remove{
    display:none;
}
.show{
    display:block;
    text-align:center;
}
</style>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        
        <title>Library</title>
    </head>
    <div class="top-nav">
            <a href="logout.php"><button class="butto"><span>Log Out </span></button></a>
    </div>
    <body id="body-pd" >
        <div class="l-navbar" id="navbar"  >
            <nav class="nav" >
                <div >
                    <div class="nav__brand" >
                        <ion-icon name="menu-outline" class="nav__toggle" id="nav-toggle"></ion-icon>
                        <a href="#" class="nav__logo" >Library</a>
                    </div>
                    <div>
                            <div id="small-pic">
                              <a href="librarian-profile.php"><img src="assets/photo.jpeg" width="44" height="44" style="border-radius: 50%;"  ></a>
                            </div>
                            <br>
                            <div class="p" id="large-pic" >
                                <a href="librarian-profile.php"><img src="assets/photo.jpeg" width="165" height="178" style="border-radius: 50%;" ></a>
                                <p>
                                  <?php echo $_SESSION['username']; ?>
                                </p>
                            </div>       
                    </div>
                    
                    <div class="nav__list">
                        
                        <a href="librarian-home.php" class="nav__link active">
                            <ion-icon name="home-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="librarian-profile.php" class="nav__link active1">
                            <ion-icon name="person-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">Profile</span>
                        </a>
                        
                        <div class="nav__link collapse active3">
                            <ion-icon name="book-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">Books</span>

                            <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                            <ul class="collapse__menu">
                                <a href="librarian-allbooks.php" class="collapse__sublink">AllBooks</a><br>
                                <a href="#" class="collapse__sublink">BookStatus</a><br>
                                <a href="librarian-finestatus.php" class="collapse__sublink">FineStatus</a>
                            </ul>
                        </div>
                      
                        <a href="librarian-allmembers.php" class="nav__link active2">
                            <ion-icon name="people-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">Members</span>
                        </a>
                        <!--
                        <a href="librarian-bookstatus.php" class="nav__link active3">
                            <ion-icon name="cash-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">BookStatus</span>
                        </a>
                        -->
                        <!--
                        <div  class="nav__link collapse">
                            <ion-icon name="folder-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">Fine</span>

                            <ion-icon name="chevron-down-outline" class="collapse__link"></ion-icon>

                            <ul class="collapse__menu">
                                <a href="#" class="collapse__sublink">Data</a>
                                <a href="#" class="collapse__sublink">Group</a>
                                <a href="#" class="collapse__sublink">Members</a>
                            </ul>
                        </div>
                        -->        
                        <a href="librarian-circular.php" class="nav__link active4">
                            <ion-icon name="notifications-outline" class="nav__icon"></ion-icon>
                            <span class="nav__name">Circulars</span>
                        </a>

                    </div>
                </div>

                <a href="logout.php" class="nav__link">
                    <ion-icon name="log-out-outline" class="nav__icon"></ion-icon>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>
        
        <!-- ===== IONICONS ===== -->
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        
        <!-- ===== MAIN JS ===== -->
        <script>
            /*===== EXPANDER MENU  =====*/ 
            const showMenu = (toggleId, navbarId, bodyId,smallId,largeId)=>{
            const toggle = document.getElementById(toggleId),
            navbar = document.getElementById(navbarId),
            bodypadding = document.getElementById(bodyId),
            small=document.getElementById(smallId),
            large=document.getElementById(largeId)

            if(toggle && navbar){
                toggle.addEventListener('click', ()=>{
                navbar.classList.toggle('expander')
                small.classList.toggle('remove')
                large.classList.toggle('show')
                bodypadding.classList.toggle('body-pd')
                })
            }
            }
            showMenu('nav-toggle','navbar','body-pd','small-pic','large-pic')

            /*===== LINK ACTIVE  =====*/ 
            const linkColor = document.querySelectorAll('.nav__link')
            function colorLink(){
            linkColor.forEach(l=> l.classList.remove('active'))
            this.classList.add('active')
            }
            linkColor.forEach(l=> l.addEventListener('click', colorLink))


            /*===== COLLAPSE MENU  =====*/ 
            const linkCollapse = document.getElementsByClassName('collapse__link')
            var i

            for(i=0;i<linkCollapse.length;i++){
            linkCollapse[i].addEventListener('click', function(){
                const collapseMenu = this.nextElementSibling
                collapseMenu.classList.toggle('showCollapse')

                const rotate = collapseMenu.previousElementSibling
                rotate.classList.toggle('rotate')
            })
            }
        </script>
    </body>
</html>