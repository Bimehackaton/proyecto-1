//FUNCIONES PARA TODA LA APLICACION
    function rand (min, max) {
      	return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    
    function _(id){
        return document.getElementById(id);
    }



//FUNCION PARA CUANDO SE CARGA Y REDIMENSIONA LA APLICACION
    window.onload=function(){
    	load();
    }
    window.onresize=function(){
    	load();
    }



//VARIABLES DE LA APLICACION
    var w, h;



//FUNCION INICIAL Y DE RECARGA DE LA APLICACION
    function load(){
    	w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    	h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
    
    
        _('cuerpo').style.height = h + 'px';
        
        
        
        _('left').style.height = (h - 75) + 'px';
        
        
        _('contenido').style.width = (w - 76) + 'px';
        _('contenido').style.height = (h - 76) + 'px';
        
        
        
        
        var fire = false;
        _('fire').onclick = function(){
            if(fire){
                _('novedades').style.display = 'none';
                fire = false;
            }
            else{
                _('novedades').style.display = 'block';
                fire = true;
            }
        };
        
        
        
        
        
        
        
        
        
        
        
        
        try {
            modulo();
        }catch(e){
            
        }
    }