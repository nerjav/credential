import AppForm from '../app-components/Form/AppForm';

Vue.component('credential-form', {
    mixins: [AppForm],
    props: ['category','service'],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                url:  '' ,
                password:  '' ,
                category:  '' ,
                service:  '' ,

            }
        }
    }

});
