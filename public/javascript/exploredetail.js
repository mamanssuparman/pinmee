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
        url: window.location.origin +'/getDataExplore/'+ '?page='+paginate,
        type: "GET",
        dataType: "JSON",
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

$.ajax({
    url: window.location.origin +'/explore-detail/'+segmentTerakhir+'/getdatadetail',
    type: "GET",
    dataType: "JSON",
    success: function(res){
        console.log(res)
        $('#fotodetail').prop('src', '/assets/'+res.dataDetailFoto.url)
        $('#judulfoto').html(res.dataDetailFoto.judul_foto)
        $('#deskripsifoto').html(res.dataDetailFoto.deskripsi_foto)
        $('#jumlahpengikut').html(res.dataJumlahFollow.jmlfolow + ' Pengikut');
        $('#username').html(res.dataDetailFoto.user.nama_lengkap)
        ambilKomentar()
        var idUser ;
        if(res.dataFollow == null){
            idUser=""
        } else {
            idUser = res.dataFollow.id_user
        }
        if(res.dataDetailFoto.id_user === res.dataUser){
            $('#tombolfollow').html('')
        } else {
            if(idUser == res.dataUser){
                $('#tombolfollow').html('<button class="px-4 rounded-full bg-bgcolor2" onclick ="ikuti(this, '+res.dataDetailFoto.id_user+')">Tidak Ikuti</button>')
            } else {
                $('#tombolfollow').html('<button class="px-4 rounded-full bg-bgcolor2" onclick ="ikuti(this, '+res.dataDetailFoto.id_user+')">Ikuti</button>')
            }
        }
    },
    error: function(jqXHR, textStatus, errorThrown){
        alert('gagal')
    }
})

function ambilKomentar(){
    $.getJSON(window.location.origin +'/explore-detail/getComment/'+segmentTerakhir, function(res){
        // console.log(res)
        if(res.data.length === 0){
            $('#listkomentar').html('<div>belum ada komentar</div>')
        } else {
            comment= []
            res.data.map((x)=>{
                let datacomentar = {
                    idUser: x.user.id,
                    pengirim: x.user.nama_lengkap,
                    waktu: x.created_at ,
                    isikomentar: x.isi_komentar,
                    potopengirim: x.user.pictures
                }
                comment.push(datacomentar);
            })
            tampilkankomentar()
        }
    })
}

const tampilkankomentar = ()=>{
    $('#listkomentar').html('')
    comment.map((x, i)=>{
        $('#listkomentar').append(`
            <div class="flex flex-row justify-start mt-4">
                <div class="w-1/4">
                    <img src="/assets/${x.potopengirim}" class="w-8 h-auto" alt="">
                </div>
                <div class="flex flex-col mr-2">
                    <h5 class="text-sm">${x.pengirim}</h5>
                    <small class="text-xs text-abuabu">${new Date(x.waktu).toLocaleDateString("id") }</small>
                </div>
                <h5 class="text-sm">${x.isikomentar}</h5>
            </div>
        `)
    })
}

function kirimkomentar(){
    $.ajax({
        url: window.location.origin +'/explore-detail/kirimkomentar',
        type: "POST",
        dataType: "JSON",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: segmentTerakhir,
            isi_komentar: $('input[name="textkomentar"]').val()
        },
        success: function(res){
            $('input[name="textkomentar"]').val('')
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal mengirim komentar')
        }
    })
}

setInterval(ambilKomentar, 500);

function ikuti(txt, idfollow){
    $.ajax({
        url: window.location.origin +'/explore-detail/ikuti',
        type: "POST",
        dataType: "JSON",
        data: {
            idfollow: idfollow,
            _token: $('input[name="_token"]').val()
        }, success: function(res){
            location.reload()
        }, error: function(jqXHR, textStatus, errorThrown){
            alert('gagal');
        }
    })
}
