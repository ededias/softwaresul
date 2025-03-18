
import axios from 'axios';
import swal from 'sweetalert2';
import { inject } from 'vue';
// const swal = inject('$swal')

interface Alert {
    title: string;
    text: string;
    icon: string;
    showCancelButton?: boolean;
    confirmButtonColor?: string;
    cancelButtonColor?: string;
    confirmButtonText?: string;
}


export const Alert = async (payload: Alert) => {
    // try {
    //     const success = await swal.fire({
    //         title: payload.title,
    //         text: payload.text,
    //         icon: payload.icon,
    //         showCancelButton: payload.showCancelButton,
    //         confirmButtonColor: payload.confirmButtonColor,
    //         cancelButtonColor: payload.cancelButtonColor,
    //         confirmButtonText: payload.confirmButtonText
    //     })
    //     console.log(success);
    // } catch (error) {}
    const success = await swal.fire({
        title: payload.title,
        text: payload.text,
        icon: payload.icon,
        showCancelButton: payload.showCancelButton,
        confirmButtonColor: payload.confirmButtonColor,
        cancelButtonColor: payload.cancelButtonColor,
        confirmButtonText: payload.confirmButtonText
    }).then(async (result) => {
        
        if (result.isConfirmed) {
            // const response = await axios.delete(`/delete/${book.id}`, {
            //     data: {
            //         _token: page.props.csrf_token
            //     }
            // });
            // books.value = await response.data.books;
            // if (response.status == 200) {
            //     swal.fire(
            //         'Deletado!',
            //         'Seu livro foi deletado.',
            //         'success'
            //     )
            // }
            return true;
        }
    });
    return success;
}