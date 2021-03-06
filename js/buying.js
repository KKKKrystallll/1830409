//Revision history:
//
//DEVELOPER DATE COMMENTS
//TianzhenSun(1830409) 2021-03-06 create file, and check buying page form data
//
$(function () {
    //the submit event of buy form
    $('#buy-form').submit(function (event) {
        //the flag of check result
        let validate = true;

        //the html dom of input
        let productCodeDom = $(this).find("input[name=product_code]"),
            firstNameDom = $(this).find("input[name=first_name]"),
            lastNameDom = $(this).find("input[name=last_name]"),
            cityDom = $(this).find("input[name=city]"),
            commentsDom = $(this).find("textarea[name=comments]"),
            priceDom = $(this).find("input[name=price]"),
            quantityDom = $(this).find("input[name=quantity]");

        //the value of form
        let productCode = productCodeDom.val(),
            firstName = firstNameDom.val(),
            lastName = lastNameDom.val(),
            city = cityDom.val(),
            comments = commentsDom.val(),
            price = priceDom.val(),
            quantity = quantityDom.val();

        //check product code
        if (!/^(p|P)/.test(productCode)) {
            productCodeDom.parents('.form-group').find('.error').text('product code must start with P or p.');
            validate = false;
        }

        //check price
        if (!/^(0|[1-9]\d*)(\.\d{1,2})?$/.test(price)) {
            priceDom.parents('.form-group').find('.error').text('Price format is wrong. price must have less than 2 digits, and can not be negative.');
            validate = false;
        } else {
            if (price > 10000) {
                priceDom.parents('.form-group').find('.error').text('Price can not be higher that 10,000.00$.');
                validate = false;
            }
        }


        //something wrong, can not submit
        if (!validate) {
            return false;
        }

        //everything is ok

        //clear all error tips
        $(this).find(".error").text('');

        //whether submit depends on user
        return confirm('Are you sure submit?');
    });
});
