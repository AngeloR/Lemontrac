if(document.getElementById('color')) {
    var e = document.getElementById('color');
    $(e).blur(function(e){
        if(isNaN(this.value)) {
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