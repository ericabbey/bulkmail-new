var imp  =  document.getElementById('address_list'),
sendList = null,
inpBox   =  $('#address'),
tbody    =  $('tbody');
imp.addEventListener("change",function(){
    if (this.files && this.files[0]) {
        var myFile = this.files[0];
        var reader = new FileReader();
        reader.addEventListener('load', function (e) {

            inpBox.val(e.target.result);
            var arr = Box.val().split(',');
            arr.forEach(function(item, index){
                console.log('today')
                appendItem(item, index)
            })
            sendList = arr;
            Checbox();
        });

        reader.readAsBinaryString(myFile);
    }
    var Box = $('#address');
});
$('.submit').on("click", function(e){
    e.preventDefault();
   if(sendList == null){
        $('.error-message').addClass('active')
        $('.error-message').children('p').text('There is no address to send mail')
   }else{
       var dataArr = [],
           content = Cookies.get('content'),
           config  = Cookies.get('config');
        dataArr.push({
            messageContent: JSON.parse(content)
       })
        dataArr.push({
            addressList: sendList
       })
        if(config != undefined){
            dataArr.push({
                messageConfig: JSON.parse(config)
            })
       }

       $.ajax({
            url : 'code/parseInput.php',
            type: 'post',
            data : {'data': dataArr},
            success: function (res) {
            //   Cookies.remove('sender');
            console.log(res);
            if(res == 1){

                }
            },
            error: function(res){
              console.log(res)
            // if(res == 0)
            //     var info = document.getElementById('info');
            //     info.classList.add = 'error';
            //     info.textContent()
            }
        });
    }
})

function appendItem(item, index){
    // console.log(item)
   var template = `<tr class="list">
                        <td> 
                            <div class="checkBox">
                                <input type="checkbox" value="None" id="checkBox" name="check" class="childCheckbox"/>
                                <label for="checkBox"></label>
                            </div>
                        </td> 
                        <td class="col-email" width=50%>
                            <p></p>${item}<p></p>
                        </td> 
                        <td class="col-tag"> 
                            <p></p><div class="btn-mail success" style="margin: 0; float: left;"><div class="btn-text">Success</div></div> <p></p>
                        </td> 
                        <td class="col-time"><p></p> -- : -- <p></p></td> 
                    </tr>`
    tbody.append(template)
}

function Checbox(){
    var parentCheckbox  = $('.parentCheckbox'),
        childCheckbox = $('.childCheckbox');

    parentCheckbox.on("click",
        function(){
            childCheckbox.attr('checked', this.checked);
        }
    );

    childCheckbox.on("click",
        function() {
            if (parentCheckbox.attr('checked') == true && this.checked == false)
                parentCheckbox.attr('checked', false);
            if (this.checked == true) {
                var flag = true;
                childCheckbox.each(function() {
                        if (this.checked == false)
                            flag = false;
                    }
                );
                parentCheckbox.attr('checked', flag);
            }
        }
    );
}