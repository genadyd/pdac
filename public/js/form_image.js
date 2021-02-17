const inputChange = ()=>{
    const input = document.getElementById('img')
    input.addEventListener('change',(e)=>{
        const patern = /\\|\//
        let val = e.target.value.split(patern)
        val = val[val.length-1]
        document.querySelector('.image_info').innerHTML = val

    })
}
inputChange()
