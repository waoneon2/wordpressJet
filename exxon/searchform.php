

<form role="search" class="form site-search-form option-b module" id="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
  <span>
    <input type="text" placeholder="Search" autocomplete="off" name="s" id="s" class="nav-search search-bar">
  </span>
  <input type="submit" class="search-submit" value="Search">
</form>

 <style type="text/css">
 
        /* Search-general styles*/
        .site-search-form.site-search-form {
            height: 80px;
            position: relative;
        }
        @media only screen and (min-width: 768px) {
            .site-search-form span {
                width: 100%;
            }
        }

        .site-search-form .search-submit {
            display: none;
        }
        .site-search-form .search-submit:hover,
        .site-search-form .search-submit:focus {
            color: #454545;
            background: #fff;
        }
        @media only screen and (min-width: 768px) {
           .site-search-form .search-submit {
           }
        }

        .site-search-form span::before {
            color: #bdbdbd;
            display: inline-block;
            font-size: 29px;
            left: 15px;
            position: absolute;
            top: 50%;
            transform: translate(0px, -50%);
            z-index: 1;
        }
        @media only screen and (min-width: 768px) {
            .site-search-form span::before {
                font-size: 33px;
                left: 30px;
            }
        }
        .site-search-form span input.search-bar {
            box-sizing: border-box;
            border: 0 none;
            color: #7b7b7b;
            float: left;
            font-family: EMprintLight, Arial, sans-serif;
            font-size: 21px;
            height: 100%;
            width: 100%;
            margin-left: 0px;
            padding-left: 80px;
            outline: 0 none;
            overflow: hidden;
            padding-top: 8px;
            position: relative;
            text-overflow: ellipsis;
            white-space: nowrap;
            box-shadow: none;
        }
        @media only screen and (min-width: 768px) {
            .site-search-form span input.search-bar {
                box-sizing: border-box;
                font-size: 35px;
                margin-left: 0px;
                padding-left: 100px;
                width: 100%;
            }
        }
        @media only screen and (min-width: 768px) {
            .site-search-form span::before {
                font-size: 33px;
                left: 30px;
            }
        }
        .icon-alt-search::before,
        .site-search-form span::before {
            content: "\f002";
            font-family: FontAwesome;
        }

        .site-search-form span::before {
            color: #bdbdbd;
            display: inline-block;
            font-size: 29px;
            left: 15px;
            position: absolute;
            top: 50%;
            transform: translate(10px, -50%);
            z-index: 1;
        }
        
        /* Header-specific styles */
        .header-site-search-wrapper {
            display: none;
            background-color: #fff;
            border-top: 2px solid #e5e5e5;
            height: 80px;
            top: -1px;
            width: 100%;
            max-width: 1400px;
            z-index: 4;
        }
        .header-site-search-wrapper .site-search-form {
            height: 100%;
        }
        .header-site-search-wrapper .site-search-form .search-submit {
            display: inline-block;
        }
        @media only screen and (min-width: 768px) {
            .header-site-search-wrapper {
                height: 115px;
            }
        }
        .header-site-search-wrapper._show {
            display: block;
        }
        .header-site-search-wrapper .site-search-form {
            height: 100%;
        }
        .header-site-search-wrapper span {
            display: inline-block;
            float: left;
            height: 100%;
            overflow: hidden;
            position: relative;
            width: 86%;
        }
        .header-site-search-wrapper .search-submit {
            border: none;
            border-left: 1px solid #bdbdbd;
            border-radius: 0;
            background: #fff;
            color: #7b7b7b;
            float: right;
            font-family: EMprintLight, Arial, sans-serif;
            font-size: 18px;
            height: 42px;
            outline: 0 none;
            position: absolute;
            top: 0;
            right: 0;
            margin: 18px 0 0;
            text-align: center;
            box-shadow: none;
        }
        @media only screen and (min-width: 768px) {
            .header-site-search-wrapper .site-search-form .search-submit {
                font-size: 22px;
                margin: 36px 0 0;
                padding: 0 30px;
            }
        }
        
        .fa-times:before{
          color: red;
          font-size: 15px;
        }
        .site-cover {
            display: none;
        }
        .site-cover._show {
            background-color: rgba(123, 123, 123, 0.9);
            display: block;
            height: 100%;
            max-width: 1400px;
            position: absolute;
            /*top: 140px;*/
            width: 100%;
            z-index: 3;
        }
        .form-control {
            display: block;
            width: 100%;
            height: 37px;
            padding: 6px 16px;
            font-size: 13px;
            line-height: 1.846;
            color: #666666;
            background-color: transparent;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 3px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);
            -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }

        textarea, textarea.form-control, input.form-control, input[type=text], input[type=password], input[type=email], input[type=number], [type=text].form-control, [type=password].form-control, [type=email].form-control, [type=tel].form-control, [contenteditable].form-control {
            padding: 0;
            border: none;
            border-radius: 0;
            -webkit-appearance: none;
            -webkit-box-shadow: inset 0 -1px 0 #ddd;
            box-shadow: inset 0 -1px 0 #ddd;
            font-size: 16px;
        }

        textarea:focus, textarea.form-control:focus, input.form-control:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="email"]:focus, input[type="number"]:focus, .form-control[type="text"]:focus, .form-control[type="password"]:focus, .form-control[type="email"]:focus, .form-control[type="tel"]:focus, .form-control[contenteditable]:focus {
            box-shadow: 0 -2px 0 #fe000c inset;
        }

        label {
            font-weight: normal;
        }

        input:-webkit-autofill, textarea:-webkit-autofill, select:-webkit-autofill {
            background-color: #fff;
            background-image: none;
            color: rgb(0, 0, 0);
        }

        .btn {
            text-transform: uppercase;
            border: none;
            -webkit-box-shadow: 1px 1px 4px rgba(0,0,0,0.4);
            box-shadow: 1px 1px 4px rgba(0,0,0,0.4);
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            transition: all 0.4s;
        }

        .btn-success:focus, .btn-success:hover {
            background: #419641;
            /* background-position: initial; */
        }
    </style>
