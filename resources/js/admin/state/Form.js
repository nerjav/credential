import AppForm from '../app-components/Form/AppForm';

Vue.component('state-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                
            }
        }
    }

});