<canvas id = "canvas" width = "640" height = "480"
        style= "border:1px solid gray; width: 640px; height: 480px;">
</canvas>

<script>
    $(document).ready(function(){
        //Initialize
        Context.create("canvas");

        var WALL  = "http://www.tigrisgames.com/wall.png";
        var CRATE = "https://banner2.kisspng.com/20180721/trr/kisspng-super-metroid-metroid-ii-return-of-samus-metroid-super-metroid-5b535a9debc3a7.0035471915321893419657.jpg";
        var image   = new Sprite(WALL,false);
        var image2  = new Sprite(CRATE,false);
        var pattern = new Sprite(CRATE, true);
        var angle = 0;

        setInterval(function(){
            Context.context.fillStyle = "#000000";
            Context.context.fillRect(0,0,800,800);

            image.draw(0,0,64,64);
            image.draw(0,74,64,64);
            pattern.draw(160,160,64,64);

            image.rotate(115,160, angle += 4.0);
            image2.rotate(115,260,-angle/2);
        },50);
    });
</script>