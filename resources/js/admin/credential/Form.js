import AppForm from '../app-components/Form/AppForm';

Vue.component('credential-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                url:  '' ,
                password:  '' ,
                category_id:  '' ,
                service_id:  '' ,
                
            }
        }
    }

});