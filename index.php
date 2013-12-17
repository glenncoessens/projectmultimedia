<!DOCTYPE html>
<html ng-app="jrrApp">
    <head>
        <meta charset="utf-8">
        <title>Project Hogent Multimedia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/jquery.validate.js" type="text/javascript"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/Scripts.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.js"></script>
        <link href="css/codiqa.ext.min.css" rel="stylesheet">
        <link href="css/jquery.mobile-1.3.1.min.css" rel="stylesheet">
        <link href="css/projectcss.css" rel="stylesheet">
        <!-- dynamicly changed stylesheet for route-->
        <link href="" rel="stylesheet" id="styleForRoute">
        <!-- end -->
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.js"></script>
        <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js"></script>
        <script src="js/jquery-mobile-angular-adapter-1.2.0.js"></script>
        <script src="js/codiqa.ext.min.js"></script>
        <script src="js/Controllers.js"></script>



    </head>
    <body ng-controller="RouteController">
        <div id="fb-root"></div>
        <script>
                function stopAudio()
                {
                    var player = document.getElementById("player");
                    player.pause();
                }
                ;
                window.fbAsyncInit = function() {
                    FB.init({
                        appId: '641532125899612',
                        status: true, // check login status
                        cookie: true, // enable cookies to allow the server to access the session
                        xfbml: true  // parse XFBML
                    });

                    // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
                    // for any authentication related change, such as login, logout or session refresh. This means that
                    // whenever someone who was previously logged out tries to log in again, the correct case below 
                    // will be handled. 
                    FB.Event.subscribe('auth.authResponseChange', function(response) {
                        // Here we specify what we do with the response anytime this event occurs. 
                        if (response.status === 'connected') {
                            // The response object is returned with a status field that lets the app know the current
                            // login status of the person. In this case, we're handling the situation where they 
                            // have logged in to the app.
                            testAPI();
                        } else if (response.status === 'not_authorized') {
                            // In this case, the person is logged into Facebook, but not into the app, so we call
                            // FB.login() to prompt them to do so. 
                            // In real-life usage, you wouldn't want to immediately prompt someone to login 
                            // like this, for two reasons:
                            // (1) JavaScript created popup windows are blocked by most browsers unless they 
                            // result from direct interaction from people using the app (such as a mouse click)
                            // (2) it is a bad experience to be continually prompted to login upon page load.
                            FB.login();
                        } else {
                            // In this case, the person is not logged into Facebook, so we call the login() 
                            // function to prompt them to do so. Note that at this stage there is no indication
                            // of whether they are logged into the app. If they aren't then they'll see the Login
                            // dialog right after they log in to Facebook. 
                            // The same caveats as above apply to the FB.login() call here.
                            FB.login();
                        }
                    });
                };

                // Load the SDK asynchronously
                (function(d) {
                    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
                    if (d.getElementById(id)) {
                        return;
                    }
                    js = d.createElement('script');
                    js.id = id;
                    js.async = true;
                    js.src = "//connect.facebook.net/en_US/all.js";
                    ref.parentNode.insertBefore(js, ref);
                }(document));

                // Here we run a very simple test of the Graph API after login is successful. 
                // This testAPI() function is only called in those cases. 
                function testAPI() {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                        console.log('Good to see you, ' + response.name + '.');
                    });
                }
        </script>



        <!--
          Below we include the Login Button social plugin. This button uses the JavaScript SDK to
          present a graphical Login button that triggers the FB.login() function when clicked. -->

        <script>
                function captureSuccess(mediaFiles) {
                    navigator.notification.alert('Success taking picture:');
                }
                function captureError(mediaFiles) {
                    navigator.notification.alert('Error taking picture: ' + error.code);
                }
                $(document).bind("deviceready", function() {
                    $("#takePhotoButton").bind("tap", function() {
                        navigator.device.capture.captureImage(captureSuccess, captureError, {limit: 1});
                    });
                });
        </script>

        <div data-role="page" data-control-title="Home" id="page1">
            <div data-theme="a" data-role="header">
                <h3>
                    Login
                </h3>
            </div>
            <div data-role="content">
                <div style="width: 288px; height: 200px; position: relative; background-color: #fbfbfb; border: 1px solid #b8b8b8;margin-left:auto;margin-right:auto;"
                     data-controltype="image" id="logo">
                    <img src="images/logo-cinquantenaire.png" alt="image" style="position: absolute;width: 100%; height: 100%">
                </div>
                <div data-role="collapsible-set">
                    <div id="facebook" data-role="collapsible" data-collapsed="false">
                        <h3>
                            Facebook
                        </h3>
                        <a data-role="button" id="fbbtn">
                            Log in
                        </a>
                    </div>                    
                </div>
                <a data-role="button" data-theme="b" href="#page2" data-icon="arrow-r"
                   data-iconpos="right">
                    Doorgaan
                </a>
            </div>
        </div>
        <div data-role="page" data-control-title="Registreer" id="page2">
            <div data-theme="a" data-role="header">
                <h3>
                    Registreer
                </h3>
            </div>
            <div data-role="content">
                <div data-controltype="textblock">
                    <p>
                        <b>
                            Bent u alleen of in groep?
                        </b>
                    </p>
                </div>
                <a data-role="button" href="#page3">
                    Alleen
                </a>
                <a data-role="button" href="#page4">
                    Groep
                </a>
            </div>
        </div>
        <div data-role="page" data-control-title="RegistreerAlleen" id="page3">
            <div data-theme="a" data-role="header">
                <h5>
                    Registreer alleen
                </h5>
            </div>
            <div data-role="content">
                <div data-controltype="textblock">
                    <p>
                        <b>
                            Vul de volgende velden in&nbsp;
                        </b>
                    </p>
                </div>
                <form action="" id="registreer">
                    <div data-role="fieldcontain" data-controltype="textinput" >
                        <label for="textinput10">
                            Gebruikersnaam
                        </label>
                        <input name="textinput10" id="textinput10" placeholder="" value="" type="text" required>
                    </div>
                    <a data-role="button" href="" data-icon="arrow-r" data-iconpos="right" id="regalleen">
                        Registreer
                    </a>
                </form>
                <a data-role="button" data-rel="back" href="#page2" data-icon="arrow-l"
                   data-iconpos="left">
                    Terug
                </a>
            </div>
        </div>
        <div data-role="page" data-control-title="RegistreerGroep" id="page4">
            <div data-theme="a" data-role="header">
                <h3>
                    Registreer team
                </h3>
            </div>
            <div data-role="content" >
                <form action="" id="registreer2">
                    <div data-role="fieldcontain" data-controltype="textinput">
                        <label for="textinput13">
                            Teamnaam
                        </label>
                        <input name="textinput13" id="textinput13" placeholder="" value="" type="text" required>
                    </div>
                    <div data-role="fieldcontain" data-controltype="slider">
                        <label for="slider1">
                            Aantal teamleden
                        </label>
                        <div class="sliderDiv">
                            <input id="slider1" type="range" name="slider" value="4" min="2" max="10"
                                   data-highlight="false">
                        </div>
                    </div>
                    <div data-controltype="textblock">
                        <p>
                            <b>
                                Voer de namen van de teamleden in
                                <br>
                            </b>
                        </p>
                    </div>
                    <div data-role="collapsible-set" data-theme="b" data-content-theme="b"
                         id="createTeamDiv">
                    </div>
                    <a data-role="button" data-inline="true" data-rel="back" href="#page2"
                       data-icon="arrow-l" data-iconpos="left">
                        Terug
                    </a>
                    <a data-role="button" id="reggroep" data-inline="true" href="" data-icon="arrow-r"
                       data-iconpos="right">
                        Creeër team
                    </a>
                </form>
            </div>
        </div>
        <div data-role="page" data-control-title="RouteSelecteren" id="page6">
            <div data-theme="a" data-role="header">
                <h5>
                    Selecteer een route
                </h5>
            </div>
            <div data-role="content" >
                <div id="routeNaam" class="ui-block-a" >
                    <div data-role="collapsible-set" data-theme="b" data-content-theme="c">
                        <div data-role="collapsible" ng-repeat="route in routes" class="onClickChangeMap" id="gotoRoute_{{route.id}}">
                            <h3>
                                {{route.name}}
                                <img src="images/finished.png" hidden id="finished_{{route.id}}" class="finishedIcon"/>
                            </h3>
                            <div data-controltype="textblock">
                                <p>
                                    {{route.subject}}
                                </p>
                            </div>
                            <a data-role="button" href="#page7" id='gotoObjects' ng-click="changeRoute(route)">
                                Doorgaan
                            </a>
                        </div>
                    </div>
                </div>
                <div id="infoRoute" class="ui-block-b" >
                    <div id="border">
                        <div data-controltype="textblock" data-theme="b">
                            <p>
                                <b>
                                    Map
                                </b>
                            </p>
                        </div>
                        <div  style=" text-align:center" data-controltype="image">
                            <img style="max-width: 90%; max-height: 75%" src="images/default.png" id="dynImg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div data-role="page" data-control-title="Route 7-1" id="page7" data-theme="i">
        <div data-theme="a" data-role="header">
            <h3 id="chosenRoute">
                {{selectedRoute.name}}
            </h3>
        </div>
        <div data-role="content">
            <a href="#popupMenu" data-role="button" data-inline="true" data-rel="popup" data-position-to="window" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" data-theme="c" aria-haspopup="true" aria-owns="#positionWindow" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c">
                <span class="ui-btn-inner ui-btn-corner-all">
                    <span class="ui-btn-text" ng-click="ObjectWink()">Kies een object</span>    
                </span>
            </a>
            <div jquery-mobile-tpl data-role="popup" id="popupMenu" >
                <ul data-role="listview" data-inset="true" id="objectlistPopup">
                    <li ng-repeat="object in objects" id="popup_{{object.sequence}}" repeat-done="" ng-cloak>
                        <a href="#page7" class="route-object" id="object_{{object.id}}" ng-click="showObject(object, selectedRoute.id)">
                            {{object.name}}
                        </a>
                        <img src="images/finished.png" hidden id="finished_{{object.sequence}}" class="finishedObject"/>
                    </li>
                    <li>
                        <a href="#page14" id="routeReflectie" ng-cloak ng-click="showReflectie(selectedRoute.id)" onclick="stopAudio()">
                            Reflectie
                        </a>
                    </li>
                </ul>
            </div>
            <div id="objectContent">
                <div id="objectName"></div>
                <div data-role="collapsible-set">
                    <div data-role="collapsible" >
                        <h3>
                            Tekst
                        </h3>
                        <div data-controltype="htmlblock" id="objectText">
                            <p> 

                            </p>
                        </div>
                    </div>
                    <div data-role="collapsible" data-collapsed="false">
                        <h3>
                            Zoek dit object
                        </h3>
                        <br>
                        <div id="imgContainer" data-controltype="image">
                            <img img style="max-width: 100%; max-height: 100%" src="" alt="image" id="dynImg" class="blurredImg">
                        </div>
                    </div>
                    <!-- temp field for retrieving objectSeq-->
                    <div id="objectSeq" hidden>
                        <p></p>
                    </div>
                    <br>
                    <!-- audio player content -->
                    <div id="audioContent">
                        <audio controls id="player" >
                            Your browser does not support the <code>audio</code> element.
                        </audio>
                    </div>
                    <!-- end audio player content -->
                    <div>
                        <input type="file" capture="camera" accept="image/*" id="takePictureField" style="display:none" onchange="readURL(this);">
                        <a data-role="button" href="#" id="neemFoto">
                            Neem foto
                        </a>
                    </div>
                </div>
                <div data-role="tabbar" data-iconpos="top" data-theme="a">
                    <ul>
                        <li>
                            <a href="#page6" data-transition="fade" data-theme="" data-icon="home" onclick="stopAudio()">
                                Routes
                            </a>
                        </li>
                        <li>
                            <a href="#page8" data-transition="slideup" data-theme="" data-icon="arrow-u" ng-click="showMapPage(selectedRoute)">
                                Map
                            </a>
                        </li>
                        <li>
                            <a href="#page9" data-transition="fade" data-theme="" data-icon="info">
                                Help
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="reflectieContent">
            <div id="reflectieVragen" hidden>
                <p>Selecteer voor iedere vraag een afbeelding, nadien kan je 1 afbeelding kiezen om op facebook te delen</p>
                <div data-role="collapsible" ng-repeat="vraag in reflectie" class="onClickChangeMap fotos" id="divVraag_{{vraag.id}}" repeatdone>
                    <h3>
                        <p id="reflectieVraag_{{vraag.id}}">{{vraag.question}}</p>
                    </h3>
                    <div data-controltype="textblock" class="afbeeldingenRoute" id="reflectieImages_{{vraag.id}}">
                        <!-- contains all images (added in RouteController directive repeatdone)-->
                    </div>
                    <div class="finishReflection" hidden>
                        <div id="selectFbPostImg"></div>
                        <label for="fbComment">Schrijf hier je/jullie ervaring:</label>
                        <input type="text" name="name" value=""/>
                        <a data-role="button" class="ui-btn-left" ng-click="postFB()" class="fbShareButton">post op facebook</a>
                    </div>

                </div>
                <!--hidden content untill all questions answered-->
                <div class="finishReflection" hidden>
                    <a data-role="button" href="#page6" ng-click="finishRoute(selectedRoute)">beëdig reflectie</a>
                </div>

            </div>
        </div>
        <div id="reflectieMessage" hidden>
            <p>

            </p>
        </div>
    </div>

    <div data-role="page" data-control-title="Help" id="page9" data-theme="i">
        <div data-theme="a" data-role="header">
            <a data-role="button" data-rel="back" href="#page7" class="ui-btn-left">
                Terug
            </a>
            <h3>
                Help
            </h3>
        </div>
        <div data-role="content">
        </div>
    </div>
    <div data-role="page" data-control-title="Help" id="page8" data-theme="i">
        <div data-theme="a" data-role="header">
            <a data-role="button" href="#page7" class="ui-btn-left" data-transition="slidedown">
                Terug
            </a>
            <h3>
                map
            </h3>
        </div>
        <div data-role="content" >
            <div  style=" text-align:center" data-controltype="image">
                <img style="max-width: 100%; max-height: 100%" src="" id="mapImg">
            </div>
        </div>
    </div>
</body>
</html>
