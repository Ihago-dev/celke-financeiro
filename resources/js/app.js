// Esse comando importa somente o arquivo boostrap.js que está dentro da pasta resources/js
import "./bootstrap";

window.confirmDelete = function (id) {
    Swal.fire({
        title: "Tem certeza que deseja excluir a conta?",
        text: "Essa ação não poderá ser desfeita!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Sim, excluir conta!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
};

// se não conseguir executar com sucesso o then vai dizer o que fazer
