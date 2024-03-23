// Receber o seletor do campo valor
let inputValor = document.getElementById('valor');

// Verificar se existe o seletor no HTML
if (inputValor) {
    // Aguardar o usuário digitar valor no campo
    inputValor.addEventListener('input', function () {

        // Obter o valor atual removendo qualquer caractere que não seja número
        let valueValor = this.value.replace(/[^\d]/g, '');

        // Adicionar os separadores de milhares
        var formattedValor = (valueValor.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueValor.slice(-2);

        // Adicionar a vírgula e até dois dígitos se houver centavos
        formattedValor = formattedValor.slice(0, -2) + ',' + formattedValor.slice(-2);

        // Atualizar o valor do campo
        this.value = formattedValor;

    });
}

function confirmDeletion(event, vacationId) {

    event.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to reverse this!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#0d6efd',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, delete!',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`formDelete${vacationId}`).submit();
        }
    })

}

// Quando carregar a página execute o select2
$(function () {
    $('.select2').select2({
        theme: 'bootstrap-5'
    });
});