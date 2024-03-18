<script src="/PassdoSv.com/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/PassdoSV.com/assets/vendor/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/PassdoSV.com/assets/vendor/jquery/jquery.min.js"></script>
<script>
    function Validator(options) {
        function validate(inputElement, rule) {
            var errorElement = inputElement.parentElement.querySelector('.form-message');
            var errorMessage = rule.test(inputElement.value);
            if (errorMessage) {
                errorElement.innerText = errorMessage;
                inputElement.parentElement.classList.add('ivalid');
            } else {
                errorElement.innerText = '';
                inputElement.parentElement.classList.remove('ivalid');
            }
        }
        var formElement = document.querySelector(options.form);
        if (formElement) {
            options.rules.forEach(function(rule) {
                var inputElement = formElement.querySelector(rule.selector);
                if (inputElement) {
                    inputElement.onblur = function() {
                        validate(inputElement, rule);
                    }
                }
            })
        }
    }
    Validator.isRequired = function(selector, message) {
        return {
            selector: selector,
            test: function(value) {
                return value.trim() ? undefined : message || 'Vui lòng không được để trống!'
            }
        }
    }
    $(document).ready(function() {
        $('.btn').click(function() {
            var kh_tendangnhap = document.getElementById('kh_tendangnhap').value;
            var kh_matkhau = document.getElementById('kh_matkhau').value;
            if (kh_matkhau == '' && kh_tendangnhap == '') {
                input = document.getElementsByClassName('input-box');
                input.classList.add('ivalid');
            }
        })
    })
</script>