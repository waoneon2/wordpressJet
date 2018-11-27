var $ = jQuery.noConflict();

var Project = {

    init: function()
    {
        $('html').removeClass('no-js');
        Project.resetCheckbox();
        Project.selectPartnerOffer();
        Project.partnerOfferSlider();
        Project.scrollTopOnNewPage();
    },
    resetCheckbox: function() {
        $("#billing0").attr('checked', false);
        $("#shipping0").attr('checked', false);

        $('input[type="radio"]').click(function() {
            if ($('#billing1').attr("checked") == "checked") {
                $('#billing-data').slideUp(800);
            }
            if ($('#billing0').attr("checked") == "checked") {
                $('#billing-data').slideDown(800);
            }

            if ($('#shipping1').attr("checked") == "checked") {
                $('#shipping-data').slideUp(800);
            }
            if ($('#shipping0').attr("checked") == "checked") {
                $('#shipping-data').slideDown(800);
            }
        });
    },
    selectPartnerOffer: function() {


        setTimeout(function(){
            var nextButton = $('.multipage_next');
                nextButton.addClass('disabled'); // Disable 'Next' button

                $('.partner-offer .button').on('click', function(e){
                    e.preventDefault();
                    var offerBox = $(this).parent('.partner-offer');
                    var amount = $(offerBox).attr('data-amount'); // amount variable (eg. 1200)
                    $('input#amount_payment').val(amount);
                    if( !offerBox.hasClass('selected') ) {
                        offerBox.siblings('.partner-offer').removeClass('selected');
                        offerBox.addClass('selected');
                        $("html, body").delay(500).animate({
                            scrollTop: $(document).height()
                        }, 1000);
                        $('#amount').html(amount); // append amount val to welcome page
                    }

                    // Enable 'Next' button
                    if( $(nextButton).hasClass('disabled') ) {
                        nextButton.removeClass('disabled');
                    }
                });
        }, 300);
     },
    partnerOfferSlider:function() {
        if($( window ).width() < 1024) {
            if(!$('.partner-offer-slider').hasClass('slick-initialized')) {
                $('.partner-offer-slider').slick({
                    infinite: false,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    variableWidth: true,
                    arrows: false,
                    centerMode: true,
                    initialSlide: 2
                });
            }
        }
        else if($('.partner-offer-slider').hasClass('slick-initialized')) {
            $('.partner-offer-slider').slick("unslick");
        }
    },
    scrollTopOnNewPage: function() {
        $("a.multipage_next").click(function() {
            $("html, body").animate({ scrollTop: 0 }, 1);
            return false;
        });
    }

};

$(document).ready(function() {
    Project.init();
});

$(window).resize(function() {
    Project.partnerOfferSlider();
});

(function (document, Heartland) {
    var iframeStyle = {
        'input[type=text], input[type=tel]': {
            'box-sizing':'border-box',
            'display': 'block',
            'width': '100%',
            'height': '52px',
            'padding': '6px 12px',
            'font-size': '14px',
            'line-height': '1.42857143',
            'color': '#555',
            'background-color': '#fff',
            'background-image': 'none',
            'border': 'solid 2px #e8e8e8 !important',
            '-webkit-box-shadow': 'inset 0 1px 1px rgba(0,0,0,.075)',
            'box-shadow': 'inset 0 1px 1px rgba(0,0,0,.075)',
            '-webkit-transition': 'border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s',
            '-o-transition': 'border-color ease-in-out .15s,box-shadow ease-in-out .15s',
            'transition': 'border-color ease-in-out .15s,box-shadow ease-in-out .15s'
        },
        'input[type=text]:focus, input[type=tel]:focus': {
            'border-color': '#62c2cc !important',
            'box-shadow': '1px 1px 0px 0px white !important'
        },
        'input[type=submit]' : {
            'box-sizing':'border-box',
            'display': 'inline-block',
            'padding': '6px 12px',
            'margin-bottom': '0',
            'font-size': '14px',
            'font-weight': '400',
            'line-height': '1.42857143',
            'text-align': 'center',
            'white-space': 'nowrap',
            'vertical-align': 'middle',
            '-ms-touch-action': 'manipulation',
            'touch-action': 'manipulation',
            'cursor': 'pointer',
            '-webkit-user-select': 'none',
            '-moz-user-select': 'none',
            '-ms-user-select': 'none',
            'user-select': 'none',
            'background-image': 'none',
            'border': '1px solid transparent',
            'border-radius': '4px',
            'color': '#fff',
            'background-color': '#337ab7',
            'border-color': '#2e6da4'
        },
        'input[type=submit]:hover': {
            'color': '#fff',
            'background-color': '#286090',
            'border-color': '#204d74'
        },
        'input[type=submit]:focus, input[type=submit].focus': {
            'color': '#fff',
            'background-color': '#286090',
            'border-color': '#122b40',
            'text-decoration': 'none',
            'outline': '5px auto -webkit-focus-ring-color',
            'outline-offset': '-2px'
        }
    }
    function main() {
        if($('#multipage').length !== 0) {
            var hps = new Heartland.HPS({
                publicKey: 'pkapi_cert_BOP9XNMjW9NNUOgb4Y',
                type:      'iframe',
                // Configure the iframe fields to tell the library where
                // the iframe should be inserted into the DOM and some
                // basic options
                fields: {
                    cardNumber: {
                        target:      'creditCardNumberInput',
                        placeholder: '•••• •••• •••• ••••'
                    },
                    cardExpiration: {
                        target:      'creditCardExpireInput',
                        placeholder: 'MM / YYYY'
                    },
                    cardCvv: {
                        target:      'creditCardCvvInput',
                        placeholder: 'CVV'
                    }
                },
                style: iframeStyle,
                // Callback when a token is received from the service
                onTokenSuccess: function (resp) {
                    var opts = {
                        url: MyAjax.ajaxurl,
                        type: 'POST',
                        async: true,
                        cache: false,
                        data:{
                            action: 'ocala_single_token_payment', // Tell WordPress how to handle this ajax request
                            token: resp.token_value, // single-token
                            amount: $('input[name=amount_payment]').val(),
                            name: $('input[name=name]').val(),
                            email: $('input[name=email]').val(),
                            memberId: $("article.selected div.member-id").text()
                        },
                        success: function(response) {
                            $('#multipage').gotopage(3)
                            var nextButton = $('.multipage_next');
                            nextButton.removeClass('disabled');
                        },
                        error: function(xhr,textStatus,e) {
                            var nextButton = $('.multipage_next');
                            nextButton.removeClass('disabled');
                        }
                    };
                    $.ajax(opts);
                },
                // Callback when an error is received from the service
                onTokenError: function (resp) {
                    var nextButton = $('.multipage_next');
                    nextButton.removeClass('disabled');
                    alert('There was an error: ' + resp.error.message);
                }
            });
        }
        function listenCaptcha(value) {
          $.ajax({
            type: 'POST',
            url: MyAjax.ajaxurl,
            async: true,
            data: {
              action: 'ocala_verify_recaptcha',
              recaptcha: value
            },
            success: function (response) {
              var resp;
              if (typeof response == 'string') {
                resp = JSON.parse(response)
              } else {
                resp = response
              }
              if (!resp.error) {
                var nextButton = $('.multipage_next');
                nextButton.removeClass('disabled');
              } else {
                alert('sorry, there are problem to verify with recaptcha')
              }
            },
            error: function (xhr,textStatus,e) {
              alert('sorry, server error occured, please contact web admin')
            }
          })
        }
        window.listenCaptcha = listenCaptcha
        $('form.multipage.form').submit(function(e) {
          createMembership();
          e.preventDefault()
        });

        function redirect_page() {
            if (LinkThanksPage.linkpage !== "none") {
                window.location.href = LinkThanksPage.linkpage
                return false;
            } else {
                $('#multipage').gotofirst();
            }
        }

        // Thank you page
        if (document.body.classList && document.body.classList.contains('page-template-thankyou-page-php')
            || (document.body.className.split(' ').indexOf('page-template-thankyou-page-php') !== -1 )) {
            // tick
            function thankYouCounter() {
                var id = setInterval(tickInterval, 1000)
                var state = 15
                function tickInterval() {
                    if (state === 0) {
                        clearInterval(id)
                        window.location.href = 'http://ocalacep.com/'
                    } else {
                        state = state - 1
                        elapsedCounter(state)
                    }
                }
            }

            function elapsedCounter(counter) {
                var text = document.createTextNode(counter)
                var elem = document.querySelector('span.elapsed')
                elem.replaceChild(text, elem.firstChild)
            }

            (function () {
                // install our counter
                thankYouCounter()
            }())
        }

        function createMembership() {
          var fullname = $("form input[name='name']").val();
          var commentsText = "Website : "+$("form input[name='cellphone']").val()+"\n"
                            +"Bussiness : "+$( "form input[name='business']:checked" ).map(function() {return this.value;}).get().join(',')+"\n"
                            +"Facebook : "+$("form input[name='companyfb']").val()+"\n"
                            +"Twitter : "+$("form input[name='personaltwitter']").val()+"\n"
                            +"Referer : "+$("form input[name='personalfb']").val()+"\n"
                            +"Company Name : "+$("form input[name='cname']").val();
          var options = {
              url: MyAjax.ajaxurl,
              type: 'POST',
              async: true,
              data: {
                  action: 'ocl_create_membership',
                  name: $("form input[name='name']").val(),
                  fname: fullname.split(' ').slice(0, -1).join(' '),
                  lname: fullname.split(' ').slice(-1).join(' '),
                  email: $("form input[name='email']").val(),
                  partnership: $('form article.selected h2.title-headline').text(),
                  companyName: $("form input[name='cname']").val(),
                  physicalAddress: $("form input[name='address']").val(),
                  physicalAddress2: $("form input[name='address2']").val(),
                  city: $("form input[name='city']").val(),
                  state: $( "form select[name='state'] option:selected" ).text(),
                  zipcode: $("form input[name='zipcode']").val(),
                  country: $( "form select[name='country'] option:selected" ).text(),
                  billing: $( "form input[name='billing']:checked" ).val(),
                  billingCname: $("form input[name='billing-cname']").val(),
                  billingAddress: $("form input[name='billing-address']").val(),
                  billingAddress2: $("form input[name='billing-address2']").val(),
                  billingCity: $("form input[name='billing-city']").val(),
                  billingState: $( "form select[name='billing-state'] option:selected" ).text(),
                  billingZipcode: $("form input[name='billing-zipcode']").val(),
                  billingCountry: $( "form select[name='billing-country'] option:selected" ).text(),
                  phone: $("form input[name='phone']").val(),
                  cellphone: $("form input[name='cellphone']").val(),
                  business: $( "form input[name='business']:checked" ).map(function() {return this.value;}).get().join(','),
                  companyfb: $("form input[name='companyfb']").val(),
                  companytwitter: $("form input[name='companytwitter']").val(),
                  personalfb: $("form input[name='personalfb']").val(),
                  personaltwitter: $("form input[name='personaltwitter']").val(),
                  referer: $("form input[name='personalfb']").val(),
                  comments: commentsText
              },
              success: function(dta) {
                   redirect_page();
              },
              error: function(xhr,textStatus,e) {
              }
          };
          $.ajax(options)
        }
        $('#multipage').on('multipage:validate', function (e, data) {
            var nextButton = $('.multipage_next');
            if (data && data.page === 1) {
                nextButton.addClass('disabled'); // Disable 'Next' button
                return
            }
            if (data && data.page !== 2) return
            // Tell the iframes to tokenize the data
            hps.Messages.post(
              {
                accumulateData: true,
                action: 'tokenize',
                message: 'pkapi_cert_BOP9XNMjW9NNUOgb4Y'
              },
              'cardNumber'
            );
            data.validate = false
            // so it's doesn't submit twice
            nextButton.addClass('disabled');
        })
    }
    document.addEventListener('DOMContentLoaded', main)
}(document, Heartland))