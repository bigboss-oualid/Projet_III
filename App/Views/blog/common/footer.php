        <div class="clearfix"></div>
    </div>
    <!--/ Content -->
    <!-- Footer -->
    <footer>
        <div class="copyrights">
            &copy;2019 My Blog All Rights Reserved
        </div>
        <div class="social">
            <a href="#" class="facebook">
                <span class="fa fa-facebook"></span>
            </a>
            <a href="#" class="google">
                <span class="fa fa-google-plus"></span>
            </a>
            <a href="#" class="twitter">
                <span class="fa fa-twitter"></span>
            </a>
            <a href="#" class="youtube">
                <span class="fa fa-youtube"></span>
            </a>
            <a href="#" class="instagram">
                <span class="fa fa-instagram"></span>
            </a>
            <a href="#" class="pinterest">
                <span class="fa fa-pinterest"></span>
            </a>
            <a href="#" class="rss">
                <span class="fa fa-rss"></span>
            </a>
        </div>
    </footer>
    <!--/ Footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= assets('blog/js/bootstrap.min.js'); ?>"></script>
    <!-- WOW JS -->
    <script src="<?= assets('blog/js/wow.min.js'); ?>"></script>
    <!-- Custom JS -->
    <script src="<?= assets('blog/js/custom.js'); ?>"></script>

<script src="<?= assets('blog/js/phone/intlTelInput.min.js'); ?>"></script>
<script src="<?= assets('blog/js/phone/intlTelInput-jquery.min.js'); ?>"></script>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">
    var input = document.querySelector("#phone");
    window.intlTelInput(input,({
    // whether or not to allow the dropdown
    // if there is just a dial code in the input: remove it on blur, and re-add it on focus
    autoHideDialCode: true,
    // add a placeholder in the input with an example number for the selected country
    autoPlaceholder: true,
    // don't display these countries
    excludeCountries: [],
    // format the input value during initialisation and on setNumber
    formatOnDisplay: false,
    // geoIp lookup function
    geoIpLookup: null,
    // inject a hidden input with this name, and on submit, populate it with the result of getNumber
    //hiddenInput: "",
    // initial country
    initialCountry: "",
    // localized country names e.g. { 'de': 'Deutschland' }
    //localizedCountries: { 'de': 'Deutschland' },
    // don't insert international dial codes
    nationalMode: false,
    // display only these countries
    //onlyCountries: [],
    // number type to use for placeholders
    placeholderNumberType: "MOBILE",
    // the countries at the top of the list. defaults to united states and united kingdom
    preferredCountries: [ "fr", "de" ],
    // display the country dial code next to the selected flag so it's not part of the typed number
    separateDialCode: false,
    }));    
</script>

  </body>
</html>