//Revision history:
//
//DEVELOPER DATE COMMENTS
//TianzhenSun(1830409) 2021-03-9 create file, and complete advertise function
//
$(function () {
    //current product that is showing
    let displayAdvertiseIndex = 0;
    //prev showed product
    let prevDisplayAdvertiseIndex = -1;

    initAdvertisePlay();

    //automatic play advertise
    function initAdvertisePlay() {
        //the number of product
        let advertises = $('#product .product-item'),
            advertiseLen = advertises.length;

        //use a timer to automatic play advertise
        setInterval(function () {
            //get the next product to show, and prev product
            if (displayAdvertiseIndex < advertiseLen - 1) {
                prevDisplayAdvertiseIndex = displayAdvertiseIndex;
                displayAdvertiseIndex++;

            } else {
                displayAdvertiseIndex = 0;
                prevDisplayAdvertiseIndex = advertiseLen - 1;
            }

            //hide prev product, then show current product
            $(advertises[prevDisplayAdvertiseIndex]).fadeOut(500, function () {
                $(advertises[displayAdvertiseIndex]).fadeIn(500);
            });
        }, 2000);
    }
});