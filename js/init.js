if(document.getElementById('color')) {
    var e = document.getElementById('color');
    $(e).blur(function(e){

        if(!this.value.match(/^(#)?([0-9a-fA-F]{3})([0-9a-fA-F]{3})?$/)) {
            document.getElementById('color-display-box').setAttribute('style','background-color: '+this.value);
        }
        else {
            if(this.value.length === 6) {
                document.getElementById('color-display-box').setAttribute('style','background-color: #'+this.value);
            }
            else if(this.value.length === 3) {
                var s = this.value, tmp = [];
                for(var i = 0, l = s.length; i < l; i++) {
                    tmp.push(s[i]);tmp.push(s[i]);
                }
                this.value = tmp.join('');
                document.getElementById('color-display-box').setAttribute('style','background-color: #'+this.value);
            }
        }
    });
}

if($('.notices').length > 0) {
    $('.notices div').click(function(e){
        $(this).remove();
        if($('.notices div').length == 0) {
            $('.notices').remove();
        }
    });
}