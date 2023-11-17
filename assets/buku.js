const getDataBuku = () => {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let data = JSON.parse(xhr.responseText)
                console.log(data)
                var table = document.getElementById('dataBuku')
                table.classList.add('border-collapse', 'w-full');

                data.forEach(function (item) {
                    var row = document.createElement('tr');
                    row.classList.add('border-b', 'dark:border-gray-600', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');

                    var titleCell = document.createElement('th');
                    titleCell.setAttribute('scope', 'row');
                    titleCell.classList.add('px-4', 'py-3', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
                    var titleDiv = document.createElement('div');
                    titleDiv.classList.add('flex', 'items-center', 'mr-3');
                    titleDiv.textContent = item.judul;
                    titleCell.appendChild(titleDiv);

                    var authorCell = document.createElement('td');
                    authorCell.classList.add('px-4', 'py-3');
                    var authorSpan = document.createElement('span');
                    authorSpan.classList.add('bg-primary-100', 'text-primary-800', 'text-xs', 'font-medium', 'px-2', 'py-0.5', 'rounded', 'dark:bg-primary-900', 'dark:text-primary-300');
                    authorSpan.textContent = item.penulis;
                    authorCell.appendChild(authorSpan);

                    var publisherCell = document.createElement('td');
                    publisherCell.classList.add('px-4', 'py-3', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
                    var publisherDiv = document.createElement('div');
                    publisherDiv.classList.add('flex', 'items-center');
                    var publisherName = document.createTextNode(item.penerbit);
                    publisherDiv.appendChild(publisherName);
                    publisherCell.appendChild(publisherDiv);

                    var descCell = document.createElement('td');
                    descCell.classList.add('px-4', 'py-3');
                    descCell.textContent = item.deskripsi;

                    var yearCell = document.createElement('td');
                    yearCell.classList.add('px-4', 'py-3');
                    yearCell.textContent = item.tahun_terbit;

                    var actionsCell = document.createElement('td');
                    actionsCell.classList.add('px-4', 'py-3', 'font-medium', 'text-gray-900', 'whitespace-nowrap', 'dark:text-white');
                    var actionsDiv = document.createElement('div');
                    actionsDiv.classList.add('flex','flex-col','md:flex-row','space-y-2', 'items-center', 'justify-center', 'space-x-4');

                    var editButton = document.createElement('a');
                    editButton.setAttribute('href', 'edit-buku.php/'+item.id);
                    editButton.classList.add('py-2', 'px-3', 'flex', 'items-center', 'text-sm', 'font-medium', 'text-center', 'text-white', 'bg-primary-700', 'rounded-lg', 'hover:bg-primary-800', 'focus:ring-4', 'focus:outline-none', 'focus:ring-primary-300', 'dark:bg-primary-600', 'dark:hover:bg-primary-700', 'dark:focus:ring-primary-800');
                    editButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"/></svg>Ubah';

                    var deleteButton = document.createElement('button');
                    deleteButton.setAttribute('type', 'button');
                    deleteButton.classList.add('flex', 'items-center', 'text-red-700', 'hover:text-white', 'border', 'border-red-700', 'hover:bg-red-800', 'focus:ring-4', 'focus:outline-none', 'focus:ring-red-300', 'font-medium', 'rounded-lg', 'text-sm', 'px-3', 'py-2', 'text-center', 'dark:border-red-500', 'dark:text-red-500', 'dark:hover:text-white', 'dark:hover:bg-red-600', 'dark:focus:ring-red-900');
                    deleteButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>Hapus';
                    deleteButton.addEventListener('click', () => {
                        const idToDelete = item.id;
                        const xhr = new XMLHttpRequest();
                        const formData = new FormData();
                        formData.append('id', idToDelete);

                        xhr.open('POST', 'buku/delete.php', true);
                        xhr.onreadystatechange = () => {
                            if (xhr.readyState === 4) {
                                console.log(xhr.response);
                                if (xhr.status === 200) {
                                    const response = JSON.parse(xhr.responseText);
                                    if (response.success) {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Sukses",
                                            text: response.message
                                        }).then((result) => {
                                            console.log(response.message);
                                            if (result.isConfirmed || result.isDismissed) {
                                                location.reload()// Pengalihan halaman setelah tombol "OK" ditekan
                                            }
                                        })

                                    } else {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Ups...",
                                            text: response.message
                                        });
                                        console.log('Gagal menambahkan buku:', response.message);
                                    }
                                } else {
                                    console.log('Kesalahan: ', xhr.status);
                                    // Lakukan penanganan kesalahan lain jika diperlukan
                                }
                            }
                        };

                        xhr.send(formData);
                    });

                    actionsDiv.appendChild(editButton);
                    actionsDiv.appendChild(deleteButton);
                    actionsCell.appendChild(actionsDiv);

                    row.appendChild(titleCell);
                    row.appendChild(authorCell);
                    row.appendChild(publisherCell);
                    row.appendChild(descCell);
                    row.appendChild(yearCell);
                    row.appendChild(actionsCell);

                    table.appendChild(row);
                });

            } else {
                console.error('Terdapat masalah saat melakukan permintaan.');
            }
        }
    }
    xhr.open('GET', 'buku/retrieve.php', true);
    xhr.send();
}

const form = document.getElementById('tambahBuku'); // Menggunakan ID dari form modal
const modal = document.getElementById('tambahBukuModal');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    try {
        const xhr = new XMLHttpRequest();
        const formData = new FormData(form);

        xhr.open('POST', 'buku/create.php', true);

        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    // console.log(response);
                    if (response.success) {
                        modal.classList.add('hidden'); // Menyembunyikan modal setelah berhasil
                        Swal.fire({
                            icon: "success",
                            title: "Sukses",
                            text: response.message
                        }).then((result) => {
                            console.log(response.message);
                            if (result.isConfirmed || result.isDismissed) {
                                location.reload()// Pengalihan halaman setelah tombol "OK" ditekan
                            }
                        })

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Ups...",
                            text: response.message
                        });
                        console.log('Gagal menambahkan buku:', response.message);
                    }
                } else {
                    console.log('Kesalahan: ', xhr.status);
                }
            }
        };

        xhr.send(formData);
    } catch (error) {
        console.error('Terjadi kesalahan:', error);
    }
});