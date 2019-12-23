export const ToadAlert = {
    toad: function (mensaje) {
        const ToastUpdate = Swal.mixin({
            toast: true,
            position: 'top-start',
            showConfirmButton: false,
            timer: 3000,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        ToastUpdate.fire({
            icon: 'success',
            title: mensaje
        });
    }
};
