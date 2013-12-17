var myAppModule = angular.module('jrrApp', ['ui.bootstrap']);
var urlService = '/Project';

myAppModule
        .service('sharedProperties', function() {
            var chosenRoute;

            return {
                getChosenRoute: function() {
                    return chosenRoute;
                },
                setChosenRoute: function(value) {
                    chosenRoute = value;
                },
                showRoutes: function($scope, $http, sharedProperties, route) {
                    $routeId = sharedProperties.getChosenRoute();
                    $route = route;
                    var httpRequest = $http({
                        method: 'GET',
                        url: urlService + '/services/service.php?action=getObjects&id=' + $routeId}).success(function(data) {
                        $scope.objects = data.objects;
                    });
                    $scope.selectedRoute = $route;

                }
            };
        });

myAppModule.controller('RouteController', function($scope, $http, sharedProperties) {

    var httpRequest = $http({
        method: 'GET',
        url: urlService + '/services/service.php?action=getRoutes',
    }).success(function(data) {
        $scope.routes = data.routes;
    });
    $scope.changeRoute = function(route) {
        //remove all storage files (images) of previous route
        var storageFiles = JSON.parse(localStorage.getItem("storageFiles"));
        if (storageFiles != null) {
            $.each(storageFiles, function(i, item) {
                localStorage.removeItem(item);
            });
            // remove array that contained keys to images
            localStorage.removeItem("storageFiles");
        }
        //add css to head according to chosen route
        $("#styleForRoute").attr("href", 'css/route' + route.id + '.css');
        // setting and showing route
        sharedProperties.setChosenRoute(route.id);
        sharedProperties.showRoutes($scope, $http, sharedProperties, route);
        //set content screen of object to guide
        $("#objectContent").hide();
        $('#reflectieVragen').hide();
        $('#reflectieMessage').hide();
        $(".finishReflection").hide();
        $(".fbShareButton").hide();
    };
    //function called after selecting object in popup of route
    $scope.showObject = function(object, chosenroute) {
        //remove previous object-data
        $('#reflectieVragen').hide();
        $('#reflectieMessage').hide();
        $(".finishReflection").hide();
        $(".fbShareButton").hide();
        $("#objectName").children().remove();
        $("#objectName").append("<h1>" + object.name + "</h1>");
        $("#objectText").children().remove();
        //change content of screen to chosen object
        $("#objectText").append("<p>" + object.description + "</p>");
        var img = "images/r" + chosenroute + "/r" + chosenroute + "obj" + object.sequence + ".png";
        $("#objectSeq p").html(object.sequence);
        var objectSeq = $('#objectSeq p').html();
        $("#imgContainer img").attr("src", img);
        $('imgContainer img').on('dragstart', function(event) {
            event.preventDefault();
        });
        $('#player').attr("src", 'audio/' + object.audio);
        $('#objectContent').fadeIn("slow");
        document.getElementById('player').play();
        $scope.finishRoute = function(selectedRoute)
        {
            //change routeselection's route to finished
            $("#finished_" + selectedRoute.id).show();
        };
    };
    //function for showing reflection
    $scope.showReflectie = function(routeId) {
        // if all objects have been completed -> do request to server
        $('#objectContent').fadeOut("slow");
        var storageFiles = JSON.parse(localStorage.getItem("storageFiles"));
        var storageFilesArray = Object.keys(storageFiles);
        //var routeValid = storageFilesArray.length == $scope.objects.length;
        var routeValid = true;
        if (routeValid && sharedProperties.getChosenRoute())
        {
            $routeId = routeId;
            var httpRequest = $http({
                method: 'GET',
                url: urlService + '/services/service.php?action=getReflectie&id=' + $routeId}).success(function(data) {
                $scope.reflectie = data.reflectie;
            });
            // add images to div for each question, so user can choose one 
            // show content of reflection
            $('#reflectieVragen').fadeIn("slow");
        }
        // else show message to complete other objects
        else
        {
            $('#reflectieMessage p').html('Doorloop eerst alle overgebleven objecten in de route vooraleer je doorgaat naar de reflectie');
            $('#reflectieMessage').fadeIn("slow");
        }


    };
    $scope.showMapPage = function(selectedRoute) {
        var link = 'images/gf' + selectedRoute.id + '.png';
        $("#mapImg").attr("src", link);
    };
    $scope.ObjectWink = function(){
        var storageFilesArray = Object.keys(JSON.parse(localStorage.getItem("storageFiles")));
        $.each(storageFilesArray, function(i, item){
            var selectedpopup = $('#popup_' + item + ' img');
            selectedpopup.show();
        });
    };
    
    
    
    
    
    $scope.postFB = function() {
        var id = "reflectieImages_";
        //if no comment inserted
        //var text = $("#" + vraagId).next().children("input").attr('value');
        //var image = $("#" + vraagId + " .chosenImg");
        //alert(text);
        //alert(image);


        FB.login(function(response) {
            if (response.authResponse) {
                var accessToken = response.authResponse.accessToken;
                var userId = response.authResponse.userID;
            }
            var imgData = localStorage.getItem(1);
            imgData = imgData.replace('data:image/png;base64,', '');
            try {
                var blob = dataURItoBlob(imgData, 'image/png');
            } catch (e) {
                console.log(e);
            }
            var fd = new FormData();
            fd.append("access_token", accessToken);
            fd.append("source", blob);
            fd.append("message", "Dit was mijn favoriete object in het museum.");
            try {
                $.ajax({
                    url: "https://graph.facebook.com/" + userId + "/photos?access_token=" + accessToken,
                    type: "POST",
                    data: fd,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        //alert("success " + data);
                    },
                    error: function(shr, status, data) {
                        //alert("error " + data + " Status " + shr.status);
                    },
                    complete: function() {
                        //alert("Ajax Complete");
                    }
                });

            } catch (e) {
                console.log(e);
            }
        }, {scope: 'user_likes,offline_access,publish_stream,photo_upload'});
    };

    function dataURItoBlob(dataURI, mime) {
        // convert base64 to raw binary data held in a string
        // doesn't handle URLEncoded DataURIs

        var byteString = window.atob(dataURI);

        // separate out the mime component


        // write the bytes of the string to an ArrayBuffer
        //var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(byteString.length);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }

        // write the ArrayBuffer to a blob, and you're done
        var blob = new Blob([ia], {type: mime});

        return blob;
    }


});




// directive to add images to div's created by ng-repeat in reflection (with class fotos)
myAppModule.directive('repeatdone', function() {
    return function(scope, element, attrs) {
        // When the last element is rendered
        if (scope.$last) {
            $('#reflectieVragen').children('.fotos').each(function() {
                var dit = $(this);
                var foto;
                var storageFiles = JSON.parse(localStorage.getItem("storageFiles")) || {};
                $.each(storageFiles, function(i, item) {
                    foto = localStorage.getItem(item);
                    var image = document.createElement('img');
                    image.setAttribute("src", foto);
                    $(image).addClass("imagesSelecteren");
                    // handler for selecting images
                    $(image).on("click", function() {
                        var Images = $('.afbeeldingenRoute', dit).children();
                        var alreadySelect = false;
                        $.each(Images, function(i, item) {
                            var item2 = item;
                            if ($(item).hasClass('chosenImg'))
                            {
                                alreadySelect = true;
                                if ($(this).hasClass('chosenImg'))
                                {
                                    $(this).removeClass('chosenImg');
                                    alreadySelect = false;
                                }
                            }
                        });
                        if (!alreadySelect)
                        {
                            $(this).addClass('chosenImg');

                        }
                        
                        //check if all images for questions have been selected -> unhide end reflection
                        var countImg = $('.chosenImg').length;
                        var countQuestions = $('.fotos').length;
                        if (countImg == countQuestions)
                        {
                            $(".finishReflection").fadeIn('5');
                            $(".fbShareButton").fadeIn('5');
                        }

                    });
                    // end handler
                    // append image
                    $('.afbeeldingenRoute', dit).append(image);
                });
            });
        }
    };
});




