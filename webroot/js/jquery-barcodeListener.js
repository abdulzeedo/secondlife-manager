var BarcodeScanner = function(options) {
    this.initialize.call(this, options);
};

BarcodeScanner.prototype = {
    initialize: function(options) {
        $.extend(this._options,options);
        $(document).on({
            keyup: $.proxy(this._keyup, this)
        });
    },
    fire: function(str){
        $(document).trigger('barcode',str);
    },
    _options: {timeout: 600, prefixKeyCode: 52, suffixKeyCode: 13, minKeyCode: 32, maxKeyCode: 126},
    _isReading: false,
    _timeoutHandler: false,
    _inputString: '',
    _keyup: function (e) {
        if(this._isReading){
            if(e.keyCode==this._options.suffixKeyCode){
                //read end
                if (this._timeoutHandler)
                    clearTimeout(this._timeoutHandler);
                this._isReading=false;
                this.fire.call(this,this._inputString);
                this._inputString='';
            }else{
                //char reading
                if(e.which>=this._options.minKeyCode && e.which<=this._options.maxKeyCode)
                    this._inputString += String.fromCharCode(e.which);
            }
        }else{
            if(e.keyCode==this._options.prefixKeyCode){
                //start reading

                this._isReading=true;
                this._timeoutHandler = setTimeout($.proxy(function () {
                    //read timeout
                    this._inputString='';
                    this._isReading=false;
                    this._timeoutHandler=false;
                }, this), this._options.timeout);
            }
        }
    }
};