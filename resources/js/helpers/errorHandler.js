import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3';
import {useStore} from 'vuex';

const errorHandler = (error,store = ()=>{} )=>{
    console.log(error);
    if(error.response.status !== 422){  
       
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error.message,
            footer: 'Por favor inténtalo de nuevo'
        }).then(()=>{
            store.commit('toggleLoader');
        });
    }
}
export default errorHandler;