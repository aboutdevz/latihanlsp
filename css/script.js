var modal01 = document.getElementById('id01');
var modal02 = document.getElementById('id02');
var addUserModal = document.getElementById('addUserModal');
var updateUserModal = document.getElementById('updateUserModal');
var modalButton01 = document.getElementById('id01-trigger');
var idUpdate = document.getElementById('id-update');
var namaprinterButton = document.getElementById('namaprinter');
var detailModalButton = document.getElementById('detailModalButton');
var spesifikasiButton = document.getElementById('spesifikasi');
var detailModal = document.getElementById('detailModal');
var hargaButton = document.getElementById('harga');
var idUserUpdate = document.getElementById('idUserUpdate');
var namaPrinterUser = document.getElementById('namaPrinterUser');
var jumlahUser = document.getElementById('jumlahUser');
var baseUrl = 'http://localhost/lsp2021/fikri h badjeber/pemograman web/';

var user = 'user';
var admin = 'admin';




window.onclick = function(event)
{
    if (event.target == modal02)
    {
        modal02.style.display = "none";
    }
    else if (event.target == modal01)
    {
        modal01.style.display = "none";
    }
    else if (event.target == addUserModal)
    {
        addUserModal.style.display = "none";
    }
    else if (event.target == updateUserModal)
    {
        updateUserModal.style.display = "none";
    }
    else if (event.target == detailModalButton)
    {
        detailModal.style.display = "none";
    }
}

modalButton01.onclick = function(event)
{
    modal01.style.display = "block";
    
}

detailModalButton.onclick = function(event)
{
    detailModalButton.style.display = "block";
}

function showAddUser()
{
    addUserModal.style.display = "block";
}

var getButtonUpdate = function(event)
{
    idUpdate.setAttribute('value', event.getAttribute('data-id')); 
    namaprinterButton.setAttribute('value', event.getAttribute('data-namaprinter'));
    spesifikasiButton.setAttribute('value', event.getAttribute('data-spesifikasi'));
    hargaButton.setAttribute('value', event.getAttribute('data-harga')); 
    modal02.style.display = "block";



}

function updateUser(event)
{
    idUserUpdate.setAttribute('value', event.getAttribute('data-id')); 
    namaPrinterUser.setAttribute('value', event.getAttribute('data-idprinter'));
    jumlahUser.setAttribute('value', event.getAttribute('data-jumlah'));
    updateUserModal.style.display = "block";
}

function konfirmasi(elem,from)
{
    console.log(elem,from);
    switch (from) {
        case 'user':
            var id = elem.getAttribute('data-id');
            var state = confirm('Yakin pesanan mau dihapus?');
            if (state)
            {
                window.location.href = baseUrl + 'process/delete.php?id=' + id;
            }
            break;
        case 'admin':
            var id = elem.getAttribute('data-id');
            var state = confirm('yakin produk mau dihapus?');
            if (state)
            {
                window.location.href = baseUrl + 'process/delete_produk.php?id=' + id;
            }
            break;
        default:
            break;
    }
}



