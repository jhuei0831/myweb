<script>
    import { confirmed, email, digits, max, regex, required } from 'vee-validate/dist/rules'
    import { ValidationProvider, ValidationObserver, extend } from 'vee-validate';
    
    extend('confirmed', {
        ...confirmed,
        message: '{_field_}必須等於{length}個數字. ({_value_})',
    })

    extend('digits', {
        ...digits,
        message: '{_field_}必須等於{length}個數字. ({_value_})',
    })

    extend('email', {
        ...email,
        message: '{_field_}格式必須正確',
    })

    extend('max', {
        ...max,
        message: '{_field_}不能超過{length}個字',
    })

    extend('password', {
        params: ['target'],
        validate(value, { target }) {
            return value === target;
        },
        message: '密碼與確認密碼不相符'
    });

    extend('regex', {
        ...regex,
        message: '{_field_}{_value_}和{regex}不相符',
    })

    extend('required', {
        ...required,
        message: '{_field_}為必填',
    })   
    
    export default {
        components: {
            ValidationProvider,
            ValidationObserver,
        },
    };
</script>