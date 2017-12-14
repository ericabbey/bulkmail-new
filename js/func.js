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
            arr.forEach(function(e,i){
                arr[i] = e.trim()
            })
            validEmail = emailFilter(arr);
            validEmail.forEach(function(item, index){  
                console.log('today')
                appendItem(item, index)
            })
            sendList = validEmail;
            Checbox();
        });

        reader.readAsBinaryString(myFile);
    }
    var Box = $('#address');
});
$('.submit').on("click", function(e){
    e.preventDefault();
    if(!$(this).parent().hasClass('disabled')){
        if(sendList == null){
            message('error', 'There is no address to send mail')
       }else{
            var dataArr    = [],
               content   = Cookies.get('content'),
               senders    = Cookies.get('senders');
               config = Cookies.get('config');
            dataArr.push({
                messageContent: JSON.parse(content)
            })
            dataArr.push({
                addressList: sendList
            })
            if(senders != undefined){
                dataArr.push({
                    sendersList: JSON.parse(senders)
                })
           }
           if(config != undefined){
                dataArr.push({
                    messageConfig: JSON.parse(config)
                })
           }
           console.log(dataArr)
           $.ajax({
                url : 'code/parseInput.php',
                type: 'post',
                data : {'data': dataArr},
                beforeSend: function(){
                    console.log('sending')
                    message('prog', 'Sending ...')
                    $('.submit').text('Sending');
                    $('.submit').parent().addClass('disabled');
                    $('.btn-mail').attr('class', 'btn-mail disabled');
                    $('.addr-btn').html('sending');
                },
                success: function (res) {
                    if(res == 1){
                        message('success', 'successfully sent '+sendList.length+ ' emails');
                        $('.btn-mail').attr('class', 'btn-mail success ');
                        $('.addr-btn').html('success');
                    }else{
                        message('error', res)
                        $('.btn-mail').attr('class', 'btn-mail fail ');
                        $('.addr-btn').html('failed');
                    }
                    $('.submit').text('Send');
                    $('.submit').parent().removeClass('disabled')
                },
                error: function(res){
                  console.log(res)
                  message('fail', 'OOps an error occured. Check console log')
                }
            });
        }
    }else{
        console.log('already sending')
    }
})

function appendItem(item, index){
    // console.log(item)
   var template = `<tr class="list"> 
                        <td class="col-email" width=50%>
                            <p></p>${item}<p></p>
                        </td> 
                        <td class="col-tag"> 
                            <p></p><div class="btn-mail blue" style="margin: 0; float: left;"><div class="btn-text addr-btn">Send</div></div> <p></p>
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

function emailFilter(arr){
    message('prog', 'filtering your address')
    var clean = removeDuplicate(arr)
    var valids   = []
    var invalids = []
    clean.forEach(function(item, index){
        var valid = validateEmail(item)
        if(valid){
            valids.push(item)
        }else{
            invalids.push(item)
            handleWrongEmails(invalids)
        }
    })
    return valids;
}

function removeDuplicate(arr){
    var unique = arr.reduce(function(unique, value) {
        return unique.indexOf(value) === -1 ? unique.concat([value]) : unique;
      }, []);
      return unique;
}

function countDuplicate(arr){
    arr.reduce((count, item) => {
        if (!count[item]) {
          count[item] = 1;
        } else {
          count[item] = count[item] + 1;
        }
        console.log(count);
      }, {});

    // var duplicates;
    // const counter = arr.reduce( (count, item) => {
    //     count[item] = (count[item] || 0) + 1 ;
    //     // if(count[item] > 1) duplicates += 1
    //     console.log(count);
    // } , {})
}

function validateEmail(item){
    var pattern = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
    var state = pattern.test(item)
    return state
}
function handleWrongEmails(arr){
    message('warning', '<strong>'+arr.length + '</strong> invalid emails detected')
}
function message(code, message){
    $('.send-message').attr('class', 'send-message')
    $('.send-message').addClass(code)
    $('.send-message').children('p').html(message)
}