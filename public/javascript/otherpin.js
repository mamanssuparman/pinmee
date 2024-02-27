var segmentTerakhir = window.location.href.split("/").pop();

$.getJSON(window.location.origin +'/other-pin/getDataPin/'+segmentTerakhir, function(res){
    console.log(res)
    $('#namaUser').html(res.dataUser.nama_lengkap)
    $('#bio').html(res.dataUser.bio)
    $('#imageUser').prop('src', '/assets/'+res.dataUser.pictures)
    $('#follower').html(res.jumlahFollower[0].jmlfollower+' Pengikut')
    $('#follow').html(res.jumlahFollow[0].jmlfollow+' Mengikuti')
    if(res.dataUserActive === res.dataUser.id){
        $('#tombolikuti').html('')
    } else {
        if(res.dataFollow == null){
            $('#tombolikuti').html('<button class="px-4 mt-4 text-white bg-black rounded-full" onclick="ikuti(this, '+ res.dataUser.id +')">Ikuti</button>')
        } else {
            $('#tombolikuti').html('<button class="px-4 mt-4 text-white bg-black rounded-full" onclick="ikuti(this, '+ res.dataUser.id +')">Tidak Ikuti</button>')
        }
    }
    $('#pengikut').prop('href', '/pengikut/'+segmentTerakhir)
    $('#mengikuti').prop('href', '/mengikuti/'+segmentTerakhir)
})

function ikuti(txt, id){
    $.ajax({
        url: window.location.origin +'/explore-detail/ikuti',
        type: "POST",
        dataType: "JSON",
        data: {
            idfollow: id,
            _token: $('input[name="_token"]').val()
        },
        success: function(res){
            location.reload()
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal')
        }
    })
}

var segmentTerakhir = window.location.href.split('/').pop();
var paginate = 1;
var dataExplore = [];
loadMoreData(paginate);
$(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() >= $(document).height()){
        paginate++;
        loadMoreData(paginate);
    }
})

function loadMoreData(paginate){
    $.ajax({
        url: window.location.origin +'/getdataotherpinexplore/'+ '?page='+paginate,
        type: "GET",
        dataType: "JSON",
        data:{
            idUser: segmentTerakhir
        },
        success: function(e){
            console.log(e)
            e.data.data.map((x)=>{
                var hasilPencarian = x.likefotos.filter(function(hasil){
                    return hasil.id_user === e.idUser
                })
                if(hasilPencarian.length <= 0){
                    userlike = 0;
                } else {
                    userlike = hasilPencarian[0].id_user;
                }

                var hasilPencarianFavorite = x.favorites.filter(function(hasil){
                    return hasil.id_user === e.idUser
                })
                if(hasilPencarianFavorite.length <= 0){
                    userfavorite = 0;
                } else {
                    userfavorite = hasilPencarianFavorite[0].id_user;
                }
                let datanya = {
                    id: x.id,
                    judul: x.judul_foto,
                    deskripsi: x.deskripsi_foto,
                    foto: x.url,
                    tanggal: x.created_at,
                    jml_comment: x.comments_count,
                    jml_like: x.likefotos_count,
                    idUserLike: userlike,
                    useractive: e.idUser,
                    userFavorite: userfavorite
                }
                dataExplore.push(datanya)
                console.log(userlike)
                console.log(e.idUser)
            })
            getExplore()
        },
        error: function(jqXHR, textStatus, errorThrown){

        }
    })
}

const getExplore =()=>{
    $('#exploredata').html('')
    dataExplore.map((x, i)=>{
        $('#exploredata').append(
            `
            <div class="flex mt-2 bg-white">
                <div class="flex flex-col px-2">
                    <a href="/explore-detail/${x.id}">
                        <div class="w-[363px] h-[192px] bg-bgcolor2 overflow-hidden">
                            <img src="/assets/${x.foto}" alt=""
                                class="w-full transition duration-500 ease-in-out hover:scale-105">
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div>
                                    ${x.judul}
                                </div>
                                <div class="text-xs text-abuabu">
                                    ${x.tanggal}
                                </div>
                            </div>
                        </div>
                        <div>
                            <span class="bi ${x.userFavorite === x.useractive ? 'bi-tag-fill' : 'bi-tag'}" onclick="pinned(this, ${x.id})"></span>
                            <small>${x.jml_comment}</small>
                            <span class="bi bi-chat-left-text"></span>
                            <small>${x.jml_like}</small>
                            <span class="bi ${x.idUserLike === x.useractive ? 'bi-heart-fill text-red-800' : 'bi-heart'} bi-heart" onclick="likes(this, ${x.id})"></span>
                        </div>
                    </div>
                </div>
            </div>
            `
        )
    })
}

function likes(txt, id){
    $.ajax({
        url: window.location.origin +'/likefotos',
        dataType: "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: id
        },
        success: function(res){
            console.log(res)
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal')
        }
    })
}

function pinned(txt, id){
    $.ajax({
        url: window.location.origin +'/pinned',
        dataType: "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: id
        },
        success: function(res){
            console.log(res)
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal')
        }
    })
}
