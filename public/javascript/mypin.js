var segmentTerakhir = window.location.href.split('/').pop()
let isiDataFollower = []
$.getJSON(window.location.origin+'/mypin/getdatapengikut/', function(res){
    console.log(res)
    $('#namauser').html(res.datauser.nama_lengkap)
    $('#bio').html(res.datauser.bio)
    $('#pengikut').html(res.datajumlahpengikut[0].jmlpengikut + ' Pengikut' )
    $('#mengikuti').html(res.datajumlahmengikuti[0].jmlmengikuti + ' Mengikuti' )
    if(res.dataFollower.length >= 0){
        res.dataFollower.map((x)=>{
            let dataFollower = {
                idUser: x.id_user,
                namaUser: x.user.nama_lengkap,
                pictures: x.user.pictures,
            }
            isiDataFollower.push(dataFollower)
        })
        getDataFollower()
    }
    $('#link-pengikut').prop('href','/pengikut/'+ res.datauser.id)
    $('#link-mengikuti').prop('href', '/mengikuti/'+res.datauser.id)
})

const getDataFollower =()=>{
    $('#data-follower').html('')
    isiDataFollower.map((x,i)=>{
        $('#data-follower').append(
            `
                <div class="w-20">
                    <div class="flex flex-col items-center">
                        <img src="/assets/${x.pictures}" alt="" class="w-14">
                        <a href="/other-pin/${x.idUser}">
                            <h5 class="mt-2 text-xs">${x.namaUser}</h5>
                        </a>
                        <button class="w-full mt-1 text-xs bg-black text-white rounded-full">Ikuti</button>
                    </div>
                </div>
            `
        )
    })
}
