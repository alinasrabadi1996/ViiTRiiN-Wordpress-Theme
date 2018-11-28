<?php /* Template Name: Products-List */

get_header();

?>

<script>    
    var w = window.innerWidth
            || document.documentElement.clientWidth
            || document.body.clientWidth;
    if(w>=768){
        $("#main-header").css({"box-shadow":"none","position":"relative"});
    }
    $(window).on('scroll', function() {
        var w = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth;
        if(w>=768){
            $(".search").css("background","#FFFFFF");
            $("#main-header").css({"box-shadow":"none","position":"relative"});
                if ($(window).scrollTop() > 60) {                
                $(".categories-menu").addClass("categories-menu-fix");
                $(".categories-header-slider").css("margin-top","0px");
                $(".second-navbar-logo").addClass("scale-off");
                $(".second-navbar-logo").removeClass("hide-element");
                $(".categories-menu-list").addClass("categories-menu-list-margin");
                $(".second-navbar-categories-icons").addClass("translate-off");
            }else{
                $(".search").css("background","#FAFAFA");
                $(".categories-menu").removeClass("categories-menu-fix");
                $(".categories-header-slider").css("margin-top","-64px");
                $(".second-navbar-logo").removeClass("scale-off");
                $(".second-navbar-logo").addClass("hide-element");
                $(".categories-menu-list").removeClass("categories-menu-list-margin");
                $(".second-navbar-categories-icons").removeClass("translate-off");
            }
        }else{
            $("#main-header").css({"box-shadow":"box-shadow: 0 5px 3px -3px rgba(0,0,0,0.1)","position":"fixed"});
        }
    });
</script>

<!-- Categories Slider Start -->

<div class="categories-menu">
    <ul class="categories-menu-list">        
        <img src="<?php echo get_template_uri(); ?>/images/branding/logo.png" class="second-navbar-logo hide-element">        
        <li>
            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTcuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIxOS45OTIgMjE5Ljk5MiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjE5Ljk5MiAyMTkuOTkyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CjxwYXRoIGQ9Ik0xNDcuMjA2LDEwMi42NTdsLTMzLjE2NywzMC4zNTlsLTI3LjA3NS0yNy4wNzVsMzAuMzU5LTMzLjE2N0wxNDcuMjA2LDEwMi42NTd6IE04MS41NTcsMTExLjg0OEwzLjQzNSwxOTcuMTk1ICBjLTQuNzkzLDUuNDE2LTQuNTQxLDEzLjY2NCwwLjU3MiwxOC43NzdjMi41ODksMi41ODksNi4wMzEsNC4wMTUsOS42OTQsNC4wMTVjMy4zNDksMCw2LjU3NC0xLjIyMyw5LjEzMy0zLjQ4N2w4NS4yOTctNzguMDc3ICBMODEuNTU3LDExMS44NDh6IE0yMTEuODA5LDUwLjg5NEwxNjkuMDg1LDguMTdjLTUuMjY2LTUuMjY1LTExLjg5OC04LjE2NS0xOC42NzgtOC4xNjVjLTkuOTMzLDAtMTcuNzQ5LDYuMzg5LTE5LjQ0OSwxNS44OTcgIGwtOC45NzksNTAuMjE0bDMxLjg4NCwzMS44ODRsNTAuMjE0LTguOTc5YzcuMzA2LTEuMzA2LDEyLjc0Ni02LjAzOSwxNC45MjctMTIuOTg1QzIyMS42NDksNjcuNjEyLDIxOC44OTIsNTcuOTc4LDIxMS44MDksNTAuODk0eiIgZmlsbD0iIzAwMDAwMCIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
            <span>رژگونه</span>
        </li>
        <li>
            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTcuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIwNy45MTUgMjA3LjkxNSIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjA3LjkxNSAyMDcuOTE1OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CjxwYXRoIGQ9Ik0xNjQuNjQ3LDEzMS42NDR2LTAuNDQxYzAtMTEuODU1LTkuNjQ1LTIxLjUtMjEuNS0yMS41aC0zLjMxdi05LjA1NWMwLTcuNDQ0LTYuMDU2LTEzLjUtMTMuNS0xMy41aC0yMy4xODYgIGMyLjM4My0yMS44NDksMjAuOTI3LTM4LjkxMyw0My40LTM4LjkxM2MyNC4wODUsMCw0My42OCwxOS41OTQsNDMuNjgsNDMuNjc5QzE5MC4yMywxMDkuNTQ0LDE3OS43MjIsMTI0Ljc1MSwxNjQuNjQ3LDEzMS42NDR6ICAgTTE0Ni41NSwzMC41NWMtMzIuMjg0LDAtNTguNzE2LDI0LjkzOC02MS4xNTEsNTYuNTk4aDkuNzJjMi40MTYtMjYuMjY3LDI0LjU0NC00Ni45MTMsNTEuNDMxLTQ2LjkxMyAgYzI4LjQ5NiwwLDUxLjY4LDIzLjE4Myw1MS42OCw1MS42NzljMCwyMi4xMy0xMy45ODgsNDEuMDQzLTMzLjU4Myw0OC4zOTN2MTAuMjI2YzI1LjA1Mi03LjcyNCw0My4yNjgtMzEuMDMyLDQzLjI2OC01OC42MTkgIEMyMDcuOTE1LDU4LjAyNCwxODAuNDQxLDMwLjU1LDE0Ni41NSwzMC41NXogTTI0LjgxLDEwMC42NDd2OS4wNTVoMTA3LjAyN3YtOS4wNTVjMC0zLjAzMy0yLjQ2Ny01LjUtNS41LTUuNUgzMC4zMSAgQzI3LjI3Nyw5NS4xNDcsMjQuODEsOTcuNjE1LDI0LjgxLDEwMC42NDd6IE0xNTYuNjQ3LDEzMS4yMDJ2MzIuNjYzYzAsNy40NDQtNi4wNTYsMTMuNS0xMy41LDEzLjVIMTMuNSAgYy03LjQ0NCwwLTEzLjUtNi4wNTYtMTMuNS0xMy41di0zMi42NjNjMC03LjQ0NCw2LjA1Ni0xMy41LDEzLjUtMTMuNWgxMjkuNjQ3QzE1MC41OTEsMTE3LjcwMiwxNTYuNjQ3LDEyMy43NTgsMTU2LjY0NywxMzEuMjAyeiAgIE0xNDMuNTk0LDE0NS40OTdjMC01LjM4NS00LjM2NS05Ljc1LTkuNzUtOS43NUgyMi44MDNjLTUuMzg1LDAtOS43NSw0LjM2NS05Ljc1LDkuNzVjMCw1LjM4NSw0LjM2NSw5Ljc1LDkuNzUsOS43NWgxMTEuMDQxICBDMTM5LjIyOSwxNTUuMjQ3LDE0My41OTQsMTUwLjg4MiwxNDMuNTk0LDE0NS40OTd6IiBmaWxsPSIjMDAwMDAwIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
            <span>موس کرمی</span>
        </li>
        <li>
            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTIwOS4wNSw5LjIwN2MtNy4zNjUtMTIuMjc3LTI1LjE1NS0xMi4yNzctMzIuNTIxLDBsLTIxLjY2NSwzNi4xMDl2MTEyLjcwOGg3NS44NTJWNDUuMzE3TDIwOS4wNSw5LjIwN3oiIGZpbGw9IiMwMDAwMDAiLz4KCTwvZz4KPC9nPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNTQuODY0LDM5OC4yMjN2NzUuODUyYzAsMjAuOTQ1LDE2Ljk4MSwzNy45MjYsMzcuOTI2LDM3LjkyNmMyMC45NDUsMCwzNy45MjYtMTYuOTgxLDM3LjkyNi0zNy45MjZ2LTc1Ljg1MkgxNTQuODY0eiIgZmlsbD0iIzAwMDAwMCIvPgoJPC9nPgo8L2c+CjxnPgoJPGc+CgkJPHJlY3QgeD0iMTU0Ljg2NCIgeT0iMTk1Ljk1MSIgd2lkdGg9Ijc1Ljg1MiIgaGVpZ2h0PSIxNjQuMzQ2IiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjgxLjI4NCwyNTIuODR2MjIxLjIzNWMwLDIwLjk0NiwxNi45ODEsMzcuOTI2LDM3LjkyNiwzNy45MjZjMjAuOTQ1LDAsMzcuOTI2LTE2Ljk3OSwzNy45MjYtMzcuOTI2VjI1Mi44NEgyODEuMjg0eiIgZmlsbD0iIzAwMDAwMCIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
            <span>خط چشم</span>
        </li>
        <li>
            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDY3LjczMiA2Ny43MzIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDY3LjczMiA2Ny43MzI7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTZweCIgaGVpZ2h0PSIxNnB4Ij4KPHBhdGggZD0iTTYwLjI3MiwxMy4yMjVjLTAuNTU3LTAuNjA2LTEuNDI5LTAuODEyLTIuMTkzLTAuNTE1bC0xMC44OSw0LjE5NGMtMC4yMzMsMC4wOS0wLjQ0OCwwLjIyMy0wLjYzMywwLjM5MmwtOS41MjksOC43MzUgIHYtMTMuMTdjMC0wLjI1LTAuMDQ3LTAuNDk5LTAuMTM5LTAuNzMxTDMyLjYyMSwxLjI2OUMzMi4zMjEsMC41MDMsMzEuNTgyLDAsMzAuNzYsMHMtMS41NjEsMC41MDMtMS44NjEsMS4yNjlMMjQuNjMyLDEyLjEzICBjLTAuMDkyLDAuMjMzLTAuMTM5LDAuNDgxLTAuMTM5LDAuNzMxdjI0LjY2TDcuNTgzLDUzLjAyNGMtMC44MTQsMC43NDYtMC44NjksMi4wMTEtMC4xMjMsMi44MjZsNS43NjcsNi4yOTEgIGMwLjM1OCwwLjM5MSwwLjg1NywwLjYyNCwxLjM4NywwLjY0NmMwLjAyOSwwLjAwMSwwLjA1OCwwLjAwMiwwLjA4NywwLjAwMmMwLjUsMCwwLjk4Mi0wLjE4NywxLjM1Mi0wLjUyNmw4LjQ0LTcuNzM4djExLjIwNyAgYzAsMS4xMDQsMC44OTYsMiwyLDJoOC41MzRjMS4xMDQsMCwyLTAuODk2LDItMlY0My4wMzVsMTcuOTk5LTE2LjVjMC4xODUtMC4xNjksMC4zMzYtMC4zNzEsMC40NDUtMC41OTZsNS4xMjMtMTAuNDg1ICBDNjAuOTU1LDE0LjcxNiw2MC44MjcsMTMuODMyLDYwLjI3MiwxMy4yMjV6IE0zMC43Niw3LjQ3bDIuMTE4LDUuMzkxaC00LjIzNkwzMC43Niw3LjQ3eiBNNTIuMjIyLDIzLjQ3OGwtMi44NjMtMy4xMjNsNS40MDYtMi4wODIgIEw1Mi4yMjIsMjMuNDc4eiIgZmlsbD0iIzAwMDAwMCIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" />
            <span>مداد لب</span>
        </li>
        <li>
            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MTIgNTEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CjxnPgoJPGc+CgkJPHBhdGggZD0iTTIwOS4wNSw5LjIwN2MtNy4zNjUtMTIuMjc3LTI1LjE1NS0xMi4yNzctMzIuNTIxLDBsLTIxLjY2NSwzNi4xMDl2MTEyLjcwOGg3NS44NTJWNDUuMzE3TDIwOS4wNSw5LjIwN3oiIGZpbGw9IiMwMDAwMDAiLz4KCTwvZz4KPC9nPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNTQuODY0LDM5OC4yMjN2NzUuODUyYzAsMjAuOTQ1LDE2Ljk4MSwzNy45MjYsMzcuOTI2LDM3LjkyNmMyMC45NDUsMCwzNy45MjYtMTYuOTgxLDM3LjkyNi0zNy45MjZ2LTc1Ljg1MkgxNTQuODY0eiIgZmlsbD0iIzAwMDAwMCIvPgoJPC9nPgo8L2c+CjxnPgoJPGc+CgkJPHJlY3QgeD0iMTU0Ljg2NCIgeT0iMTk1Ljk1MSIgd2lkdGg9Ijc1Ljg1MiIgaGVpZ2h0PSIxNjQuMzQ2IiBmaWxsPSIjMDAwMDAwIi8+Cgk8L2c+CjwvZz4KPGc+Cgk8Zz4KCQk8cGF0aCBkPSJNMjgxLjI4NCwyNTIuODR2MjIxLjIzNWMwLDIwLjk0NiwxNi45ODEsMzcuOTI2LDM3LjkyNiwzNy45MjZjMjAuOTQ1LDAsMzcuOTI2LTE2Ljk3OSwzNy45MjYtMzcuOTI2VjI1Mi44NEgyODEuMjg0eiIgZmlsbD0iIzAwMDAwMCIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
            <span>خط چشم</span>
        </li>
        <li>
            <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTcuMS4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDIxMy4xNDggMjEzLjE0OCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjEzLjE0OCAyMTMuMTQ4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCI+CjxwYXRoIGQ9Ik05Ni43MzcsMjEzLjE0OEg0OC41OTVjLTIuMTQyLDAtMy44NzgtMS43MzYtMy44NzgtMy44Nzh2LTQ5LjEzNmMwLTIuMTQyLDEuNzM2LTMuODc4LDMuODc4LTMuODc4aDQ4LjE0MSAgYzIuMTQyLDAsMy44NzgsMS43MzYsMy44NzgsMy44Nzh2NDkuMTM2QzEwMC42MTUsMjExLjQxMiw5OC44NzgsMjEzLjE0OCw5Ni43MzcsMjEzLjE0OHogTTUxLjQwNSw3MC4yMDggIGMtMC4xMDEsMC0wLjE4NCwwLjA4Mi0wLjE4NCwwLjE4M0w1MS4yLDE0Ny44NzJjMCwwLjEwNSwwLjAzOCwwLjE5NywwLjExMywwLjI3MmMwLjA3NCwwLjA3NCwwLjE2NiwwLjExMiwwLjI3MSwwLjExMmw0Mi4xNDIsMC4wMTIgIGMwLjIxMiwwLDAuMzg0LTAuMTcyLDAuMzg0LTAuMzg0bDAuMDIxLTc3LjQ4MWMwLTAuMDg3LTAuMDk3LTAuMTg0LTAuMTgzLTAuMTg0TDUxLjQwNSw3MC4yMDh6IE03NC4wODIsMS45MDNMNjEuOTM2LDE0LjQ0NyAgYy0xLjEyNSwxLjE2MS0xLjc0NCwyLjY5MS0xLjc0NCw0LjMwOXYzOS45NzhjMCwxLjY3NywxLjM2NCwzLjA0MSwzLjA0MSwzLjA0MWgxOC44NjVjMS42NzcsMCwzLjA0Mi0xLjM2NCwzLjA0Mi0zLjA0MVY4LjI2MSAgYzAtMS42OC0wLjM1NC0zLjI5Ny0xLjA1My00LjgwN0M4Mi45MDcsMC45MDgsODAuNDY1LDAsNzguNTcyLDBDNzYuODY1LDAsNzUuMjcsMC42NzYsNzQuMDgyLDEuOTAzeiBNMTY4LjQzMSwyMDguOTVWNjguMzg2ICBjMC02LjM1NS01LjE1MS0xMS41MDYtMTEuNTA2LTExLjUwNmgtMzIuODg2Yy02LjM1NSwwLTExLjUwNiw1LjE1MS0xMS41MDYsMTEuNTA2VjIwOC45NWMwLDIuMzE4LDEuODc5LDQuMTk4LDQuMTk4LDQuMTk4aDQ3LjUwMiAgQzE2Ni41NTIsMjEzLjE0OCwxNjguNDMxLDIxMS4yNjksMTY4LjQzMSwyMDguOTV6IiBmaWxsPSIjMDAwMDAwIi8+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
            <span>رژلب</span>
        </li>        
    </ul>    
</div>

<!-- Categories Slider End -->


<!-- Added To Shoping Cart PopUp -->

<div class="added-product-to-shoping-list">
    <i class="material-icons">check</i>
    <p>به سبد خرید شما افزوده شد</p>    
</div>

<!-- Added To Shoping Cart PopUp -->

<!-- Categories Page Slider Start -->

<div class="categories-header-slider">
    <div class="move-to-content-arrow" onclick="goto_products('.products-list-section',58)">
        <span class="slider-move-to-title">محصولات</span>
        <i class="material-icons">keyboard_arrow_down</i>
    </div>
</div>

<!-- Categories Page Slider End -->

<!-- Categories Products Start -->

<div class="products-list-section container-fluid woocommerce">
    <div class="products-list">
        <div class="row">
            <?php
            $args = array( 'post_type' => 'product', 'posts_per_page' => 16, 'order' => 'ASC' );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
            <div class="product-item col-md-3">     
                <div class="col-container">                   
                    <div class="product-item-image">
                        <?php if(has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog hide-element categories-effect-image'); ?>
                    </div>
                    <div class="product-image">
                    <?php if(has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); ?>
                    </div>
                    <div class="product-item-information">
                        <h3 class="product-item-name"><?php the_title(); ?></h3>
                        <span class="product-item-price"><?php echo $product->get_price_html(); ?></span>
                        <div class="product-item-buy-btn">       
                            <i class="material-icons add-to-cart" title="افزودن به سبد خرید">add_shopping_cart</i>
                            <!-- <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?> -->
                            <!-- <a href="<?php echo get_permalink( $loop->post->ID ) ?>" class="product-item-buy">خرید</a> -->
                            <a href="<?php echo site_url(); ?>/introduction/?pid=<?php echo $loop->post->ID; ?>" class="product-item-buy">خرید</a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <?php endwhile;
            wp_reset_query(); 
            ?>
        </div>
        <div class="category-pages">
            <ul class="category-pages-list">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li>...</li>
                <li><a href="#">10</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Categories Products End -->

<!-- Product Preview Start -->

<div class="products-preview">
    <div class="row">
        <div class="col-lg-12">

            <!-- Product Preview List Start -->

            <ul class="products-preview-list">
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mineral-matt-lipstick-557.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مات کالاس</h3>
                    <p class="product-price">100,000 تومان<p>
                </li>
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-durable-liquid-lipstick-138.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مایع کالاس</h3>
                    <p class="product-price">20,000 تومان<p>
                </li>                
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mouse-126.png" class="product-preview-image">
                    <h3 class="product-title">موس کرمی کالاس</h3>
                    <p class="product-price">35,500 تومان<p>
                </li>   
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mineral-matt-lipstick-557.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مات کالاس</h3>
                    <p class="product-price">20,000 تومان<p>
                </li>
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-durable-liquid-lipstick-138.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مایع کالاس</h3>
                    <p class="product-price">22,900 تومان<p>
                </li>
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mineral-matt-lipstick-557.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مات کالاس</h3>
                    <p class="product-price">100,000 تومان<p>
                </li>
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-durable-liquid-lipstick-138.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مایع کالاس</h3>
                    <p class="product-price">20,000 تومان<p>
                </li>                
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mouse-126.png" class="product-preview-image">
                    <h3 class="product-title">موس کرمی کالاس</h3>
                    <p class="product-price">35,500 تومان<p>
                </li>   
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mineral-matt-lipstick-557.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مات کالاس</h3>
                    <p class="product-price">20,000 تومان<p>
                </li>
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-durable-liquid-lipstick-138.png" class="product-preview-image">
                    <h3 class="product-title">رژلب مایع کالاس</h3>
                    <p class="product-price">22,900 تومان<p>
                </li>                
                <li class="product-preview">
                    <img src="<?php echo get_template_uri(); ?>/images/misc/products-preview/callas-mouse-126.png" class="product-preview-image">
                    <h3 class="product-title">موس کرمی کالاس</h3>
                    <p class="product-price">35,500 تومان<p>
                </li>   
                                
            </ul>
            <div class="scroll-horizontal-btn right hide-element">
                <i class="material-icons">keyboard_arrow_right</i>
            </div>
            <div class="scroll-horizontal-btn left">
                <i class="icon-keyboard_arrow_left"></i>
            </div>

            <!-- Product Preview List End -->

        </div>
    </div>    
</div>

<!-- Product Preview End -->

<!-- Adadvertisement Start -->

<img class="product-banner type-2" src="<?php echo get_template_uri(); ?>/images/misc/first-ad-parallax.png"></img>
<img class="product-banner type-2" src="<?php echo get_template_uri(); ?>/images/misc/second-ad-parallax.png"></img>
<img class="product-banner type-2" src="<?php echo get_template_uri(); ?>/images/misc/third-ad-parallax.png"></img>

<!-- Adadvertisement End -->

<?php get_footer(); ?>
