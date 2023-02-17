import AppForm from '../app-components/Form/AppForm';

Vue.component('service-form', {
    props: ['state'],
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                descripcion:  '' ,
                state:  '' ,

            }
        }
    }

});
