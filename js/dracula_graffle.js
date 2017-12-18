/**
 * Originally grabbed from the official RaphaelJS Documentation
 * http://raphaeljs.com/graffle.html
 * Adopted (arrows) and commented by Philipp Strathausen http://blog.ameisenbar.de
 * Licenced under the MIT licence.
 */

/**
 * Usage:
 * connect two shapes
 * parameters:
 *      source shape [or connection for redrawing],
 *      target shape,
 *      style with { fg : linecolor, bg : background color, directed: boolean }
 * returns:
 *      connection { draw = function() }
 */
Raphael.fn.connection = function (obj1, obj2, style) {
    var selfRef = this;
    /* create and return new connection */
    var edge = {/*
        from : obj1,
        to : obj2,*/
        // style : style,
        draw : function() {
            /* get bounding boxes of target and source */
            var bb1 = obj1.getBBox();
            var bb2 = obj2.getBBox();
            var off1 = 0;
            var off2 = 0;
            /* coordinates for potential connection coordinates from/to the objects */
            var p = [
                {x: bb1.x + bb1.width / 2, y: bb1.y - off1},              /* NORTH 1 */  	//[0]
                {x: bb1.x + bb1.width / 2, y: bb1.y + bb1.height + off1}, /* SOUTH 1 */		//[1]
                {x: bb1.x - off1, y: bb1.y + bb1.height / 2},             /* WEST  1 */		//[2]
                {x: bb1.x + bb1.width + off1, y: bb1.y + bb1.height / 2}, /* EAST  1 */		//[3]
				
                {x: bb2.x + bb2.width / 2, y: bb2.y - off2},              /* NORTH 2 */		//[4]
                {x: bb2.x + bb2.width / 2, y: bb2.y + bb2.height + off2}, /* SOUTH 2 */		//[5]
                {x: bb2.x - off2, y: bb2.y + bb2.height / 2},             /* WEST  2 */		//[6]
                {x: bb2.x + bb2.width + off2, y: bb2.y + bb2.height / 2}  /* EAST  2 */    //[7]
            
			];
			
			//untuk mengarahkan arrow mau dari mana ke mana, obj nya



            /* distances between objects and according coordinates connection */
            var d = {}, dis = [];

            /*
             * find out the best connection coordinates by trying all possible ways
             */
            /* loop the first object's connection coordinates */
            for (var i = 0; i < 4; i++) {
                /* loop the second object's connection coordinates */
                for (var j = 4; j < 8; j++) {
                    var dx = Math.abs(p[i].x - p[j].x),
                        dy = Math.abs(p[i].y - p[j].y);
                    if ((i == j - 4) || (((i != 3 && j != 6) || p[i].x < p[j].x) && ((i != 2 && j != 7) || p[i].x > p[j].x) && ((i != 0 && j != 5) || p[i].y > p[j].y) && ((i != 1 && j != 4) || p[i].y < p[j].y))) 
					//syarat koneksi
					{
						//jika memenuhi syarat, maka masukkan jarak tersebut ke array dis
                        dis.push(dx + dy);
                        d[dis[dis.length - 1].toFixed(3)] = [i, j];
                    }
                }
            }
			//res = []
            var res = dis.length == 0 ? [0, 4] : d[Math.min.apply(Math, dis).toFixed(3)];
			//untuk ambil best conncetion:titk mana yg terbaik
			//[0] titik pertama dan titik kedua [4] --> secara default: dari obj1.north ke obj2.north
			//{} = is an object and there is no property length 
			//[]=This is because [] is an array object and the length is 0 because there are no elements. so [].length
			//kalo jarak koordinat koneksi bb1 dan bb2 itu 0, maka yang dikoneksikan itu north ke north
			// tapi, kalo jaraknya lebih dari 0, maka cari jarak terkecil yg paling mungkin
			
			
			
			//if (dis.length== 0)
		    // {then [0,4] }
			//	else 
		    // {d[Math.min.apply(Math, dis).toFixed(3)]};
		
			// ? = then ; the : = else
			
            /* bezier path */
            var x1 = p[res[0]].x,
                y1 = p[res[0]].y,
                x4 = p[res[1]].x,
                y4 = p[res[1]].y,
                dx = Math.max(Math.abs(x1 - x4) / 2, 10),
                dy = Math.max(Math.abs(y1 - y4) / 2, 10),
                x2 = [x1, x1, x1 - dx, x1 + dx][res[0]].toFixed(3),
                y2 = [y1 - dy, y1 + dy, y1, y1][res[0]].toFixed(3),
                x3 = [0, 0, 0, 0, x4, x4, x4 - dx, x4 + dx][res[1]].toFixed(3),
                y3 = [0, 0, 0, 0, y1 + dy, y1 - dy, y4, y4][res[1]].toFixed(3);
            /* assemble path and arrow */
            var path = ["M", x1.toFixed(3), y1.toFixed(3), 
						 "L",x4.toFixed(3), y4.toFixed(3)];

            /* arrow */
			if(style && style.directed) {
                            /* magnitude, length of the last path vector */
							//magnitude: length vector. besar ength; besar si C; a^2+b^2=c^2
							//magnitudetetap bernilai positif, walaupun arahnya negatif. Karen magnitude hanyalah besar jaraknya
							
                            //var mag = Math.sqrt((y4 - y3) * (y4 - y3) + (x4 - x3) * (x4 - x3));
                            /* vector normalisation to specified length  */
                            //var norm = function(x,l){return (-x*(l||5)/mag);};

						
							//awalnya dari contoh titik awal (x0,y0)-(x1,y1)
							//backward direction vector (dx, dy) = (x0-x1, y0-y1); kalau disini x0=x1, x1=x4
								//h = normalisasi
							//backward direction vector	
							//arah arrow nya agar mengarah dari titik target ke source
							var dirX = x1-x4;
							var dirY = y1-y4;
							
							//Satuan adalah perbandingan dalam proses pengukuran suatu besaran dengan besaran lain. setiap besaran pasti memiliki satuannya masing-masing karena tidak mungkin dua besaran memiliki satu sataun yang sama
							//hitung length-nya
							// htiung mag utk tau panjang x1-x4, y1-y4
                            var mag = Math.sqrt(Math.pow(dirX,2)+Math.pow(dirY,2));
							
							
							//menormalisasi lagi udx dan udy ; dengan membagi dx/mag dan dy/mag, agar panjangnya menjadi satu satuan							
							var udx = (dirX)/mag;                
							var udy = (dirY)/mag;
							
							//hitung pi/6 dan pi/-6 = 30 derajat
							//sin 30 = 1/2 ; cos 30 = sqrt(3)/2
							
                            ax = udx * Math.sqrt(3)/2 - udy * 1/2; // udx * cos30 - udy * sin30
                            ay = udx * 1/2 + udy * Math.sqrt(3)/2; //udx * sin30 + udy * cos30 
                            bx = udx * Math.sqrt(3)/2 + udy * 1/2; //udx * cos30 + udy * sin30
                            by =  -udx * 1/2 + udy * Math.sqrt(3)/2; //-udx * sin30 + udy * cos30 

							//pi/45
							ax2 = udx * Math.sqrt(2)/2 - udy * Math.sqrt(2)/2;
                            ay2 = udx * Math.sqrt(2)/2 + udy * Math.sqrt(2)/2;
                            bx2 = udx * Math.sqrt(2)/2 + udy * Math.sqrt(2)/2;
                            by2 =  -udx * Math.sqrt(2)/2 + udy * Math.sqrt(2)/2;
	
                            /* calculate array coordinates (two lines orthogonal to the path vector) */
							//x4 sebagai titik target
                            var arr = [
                                {x:x4+10*ax, y:y4+10*ay}, //arr[0]
                                {x:x4+10*bx, y:y4+10*by},//arr[1]
								];


                path = path + ",M"+arr[0].x+","+arr[0].y+",L"+x4+
                        ","+y4+",L"+arr[1].x+","+arr[1].y
						
						//pathnya + arrow.x + arrow.y + L + x4+y4 + arrow[1].x+arr[1].y
                        

            }
			




            /* function to be used for moving existent path(s), e.g. animate() or attr() */
            var move = "animate";
            /* applying path(s) */
            edge.fg && edge.fg[move]({path:path})
                || (edge.fg = selfRef.path(path).attr({stroke: style && style.stroke || "#000", fill: "none"}).toBack());
            edge.bg && edge.bg[move]({path:path})
                || style && style.fill && (edge.bg = style.fill.split && selfRef.path(path).attr({stroke: style.fill.split("|")[0], fill: "none", "stroke-width": style.fill.split("|")[1] || 3}).toBack());
            /* setting label */
            style && style.label
                && (edge.label && edge.label.attr({x:(x1+x4)/2, y:(y1+y4)/2})
                    || (edge.label = selfRef.text((x1+x4)/2, (y1+y4)/2, style.label).attr({fill: "#000", "font-size": style["font-size"] || "11px"})));
            style && style.label && style["label-style"] && edge.label && edge.label.attr(style["label-style"]);
            style && style.callback && style.callback(edge);



        }

    }
	
    edge.draw();
    return edge;

};






//Raphael.prototype.set.prototype.dodo=function(){console.log("works");};
