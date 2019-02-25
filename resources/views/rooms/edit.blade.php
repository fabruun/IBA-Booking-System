@extends('layouts.loggedin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header">Book et lokale</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div style="margin:15px;">
                        <div class="card" style="width:18em; list-style:none; padding:15px;">
                            <h1 style="padding:15px;">Lokale {{ $room->roomid }}</h1>
                            <li><b>Bredde:</b> {{ $room->roomwidth }} mm</li>
                            <li><b>Længde:</b> {{ $room->roomlength }} mm</li>
                            <li><b>Areal:</b> {{ $room->areasizeofroom }} m<sup>2</sup> </li>
                            <li><b>Antal:</b> {{ $room->personlimit }}</li>
                        </div>
                        <div style="margin-top:1em;">
                            <a href="/rooms/{{ $room->id }}"><button class="btn btn-primary" style="margin-right:2em;">Book nu</button></a>
                            @if(Auth::user()->type == 'admin' || Auth::user()->type == 'teacher')
                            <a href=""><button class="btn btn-primary">Omroker</button></a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1>Configurator Experimentarium</h1>
                    <p>
                        Take shapes from shape library and place them in room.
                        Draw room with user entered mesurements.
                    </p>
                    <div id='lib'>
                        <canvas id='toolbox' width='250' height='400'></canvas>
                    </div>
                    <div id='work'></div>
                    <div id='spacer'></div>
                    <div>
                        <form id='inputpanel' method='post' action='#' style="margin-top:2em;">
                            <input type='number' name='wid' placeholder='width in cms'/>
                            <input type='number' name='hei' placeholder='height in cms'/>
                            <br/>
                            <button type='button' name='bt1' class="btn btn-primary" style="margin-top:2em;">Create/Recreate Room</button>
                        </form>
                    </div>
                    <div id='calculation'></div>
                </div>
            </div>
        </div>


    </div>

@endsection
<script>
/*
    function makeCanvas() {
        //XHR
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '', true);
        xhr.onload = function() {
            if(this.status === 200) {
                let room = JSON.parse(this.responseText);
                let canvas = document.getElementById('canvasRoom');
                let ctx = canvas.getContext('2d');
                width = room.roomwidth * 100;
                length = room.roomlength * 100;
                ctx.fillStyle = '#696969';
                ctx.fillRect(0, 0, width, length);
            }
            else if(this.status === 404) {
                document.getElementById('content').innerHTML = "Not found";
            }
        }
        xhr.onerror = function() {
            document.getElementById('content').innerHTML = "Request Error";
        }
        xhr.send();

    }

    function reset() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '');
        xhr.onload = function() {
            if(this.status === 200) {
                let room = JSON.parse(this.responseText);
                let canvas = document.getElementById('canvasRoom');
                let ctx = canvas.getContext('2d');
                width = room.roomwidth * 100;
                length = room.roomlength * 100;
                ctx.fillStyle = '#696969';
                ctx.fillRect(0, 0, width, length);
            }
            else if(this.status === 404) {
                document.getElementById('content').innerHTML = "Not found";
            }
        }
        xhr.onerror = function() {
            document.getElementById('content').innerHTML = "Request Error";
        }
        xhr.send();
    }

    function standard() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', '');
        xhr.onload = function() {
            if(this.status === 200) {
                let room = JSON.parse(this.responseText);
                let canvas = document.getElementById('canvasRoom');
                let ctx = canvas.getContext('2d');
                width = room.roomwidth * 100;
                length = room.roomlength * 100;
                ctx.fillStyle = '#696969';
                ctx.fillRect(0, 0, width, length);
                ctx.fillStyle = 'black';
                ctx.fillRect(100, 100, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(300, 100, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(500, 100, 100, 100);
                ctx.fillRect(100, 300, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(300, 300, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(500, 300, 100, 100);
                ctx.fillRect(100, 500, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(300, 500, 100, 100);
                ctx.fillStyle = 'black';
                ctx.fillRect(500, 500, 100, 100);

            }
            else if(this.status === 404) {
                document.getElementById('content').innerHTML = "Not found";
            }
        }
        xhr.onerror = function() {
            document.getElementById('content').innerHTML = "Request Error";
        }
        xhr.send();
    }


    let Canvas = {
        init(canvasId, color) {
            this.canvas = document.getElementById(canvasId);
            this.context = this.canvas.getContext('2d');
            this.color = color;
            this.prep();
        },

        prep() {
            this.context.fillStyle = this.color;
            this.context.fillRect(0, 0, this.canvas.width, this.canvas.height);
        },

        clear() {
            this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
        },

        getContext() {
            return this.context;
        },

        getHeight() {
            return this.canvas.height;
        },

        getWidth() {
            return this.canvas.width;
        }
    }

    let Shape = {
        init(cv, x, y, width, height, color, price, stype) {
            this.ctx = cv.context;
            this.x = Number(x);
            this.y = Number(y);
            this.width = Number(width);
            this.height = Number(height);
            this.color = color;
            this.price = Number(price);
            this.stype = stype;
        },

        draw() {
            this.ctx.strokeStyle = 'black';
            this.ctx.lineWidth = 1;
            this.ctx.fillStyle = this.color;
            this.ctx.fillRect(this.x, this.y, this.width, this.height);
            if(this.stype === 'chimney') {
                this.ctx.strokeRect(this.x, this.y, this.width, this.height);
            }
            if(this.stype === 'door') {
                this.ctx.beginPath();
                this.ctx.moveTo(this.x + this.getWidth(), this.y + this.getHeight());
                this.ctx.arc(this.x + this.getWidth(),
                            this.y + this.getHeight(),
                            this.getWidth(),
                            Math.PI * 0.5,
                            Math.PI * 1.5,
                            false);
                this.ctx.stroke();
                this.ctx.closePath();

                this.ctx.beginPath();
                this.ctx.lineWidth = 3;
                this.ctx.fillStyle = '#999';
                this.ctx.arc(this.x + this.getWidth(), this.y + this.getHeight(),
                            this.getWidth(),
                            Math.PI * 1.5,
                            Math.pi *
                            1.1,
                            true);
                this.ctx.lineTo(this.x + this.getWidth(),
                                this.y + this.getHeight());
                this.ctx.fill();
                this.ctx.stroke();
            }
        },

        move(dx, dy) {
            this.x += dx;
            this.y += dy;
        },

        getX() {
            return this.x;
        },

        setX(x) {
            this.x = x;
        },

        getY() {
            return this.y;
        },

        setY(y) {
            this.y = y;
        },

        setContext(cv) {
            this.ctx = cv.context;
        },

        getWidth() {
            return this.width;
        },

        getHeight() {
            return this.height;
        },

        getColor() {
            return this.color;
        },

        getPrice() {
            return this.price;
        },

        getType() {
            return this.stype;
        },

        toString() {
            console.log('x: '+this.x+', y: '+this.y+
                ', width: '+this.width+', height: '+this.height+
                ', color: '+this.color+
                ', type: '+this.stype+
                ', price: '+this.price);
        },

        isOverlapping(obj) {
            if (this.x  < 0) {
                this.x = 0;
            }
            if (this.x > this.ctx.canvas.width) {
                this.x = this.ctx.canvas.width - this.width;
            }
            if (this.y < 0) {
                this.y = 0;
            }
            if (this.y > this.ctx.canvas.height) {
                this.y = this.ctx.canvas.height - this-height;
            }

            let thisleft = this.x;
            let thisright = this.x + this.getWidth();
            let thistop = this.y;
            let thisbottom = this.y + this.getHeight();

            let objleft = obj.x;
            let objright = obj.x + obj.getWidth();
            let objtop = obj.y;
            let objbottom = obj.y + obj.getHeight();

            if (!(thisleft > objright ||
                thisright < objleft ||
                thistop > objbottom ||
                thisbottom < objtop)) {
                return true;
            }
            else {
                return false;
            }
        },

        isChimneyRules(ev) {
            let rcw = false;
            let rch = false;

            if ((this.x + this.getWidth()) > (this.ctx.canvas.width - this.getWidth())) {
                this.x = this.ctx.canvas.width - this.getWidth();
                rcw = true;
            }

            if ((this.y + this.getHeight()) > (this.ctx.canvas.height - this.getHeight())) {
                this.y = this.ctx.canvas.height - this.getHeight();
                rch = true;
            }

            if (this.x > this.getWidth() && rcw === false) {
                this.x = 0;
                rcw = true;
            }

            if (this.y > this.getHeight() && rch === false) {
                this.y = 0;
                rch = true;
            }

            return (rcw || rch);
        },

        isDoorRules(ev) {
            let rcw = false;
            let rch = false;

            if ((this.x + this.getWidth()) > (this.ctx.canvas.width - this.getWidth())) {
                this.x = this.ctx.canvas.width - this.getWidth();
                rcw = true;
            }

            if ((this.y + this.getHeight()) > (this.ctx.canvas.height - this.getHeight())) {
                this.y = this.ctx.canvas.height - this.getHeight();
                rch = true;
            }

            if (this.x < this.getWidth() && rcw === false) {
                this.x = 0;
                rcw = true;
            }

            if (this.y < this.getHeight() && rch === false) {
                this.y = 0;
                rch = true;
            }
            return (rcw || rch);
        },

        isFullyInsideRoom(ev) {
            if (this.x + this.getWidth() > this.ctx.canvas.width || this.y + this.getHeight() > this.ctx.canvas.height) {
                return false;
            }
            else {
                return true;
            }
        },

        move(x, y) {
            this.x = x;
            this.y = y;
        }
    };

    let initialize = function() {
        // Create Canvas Toolbox
        box = Object.create(Canvas);
        box.init('toolbox', '#ccc');
        // Create Shapes for Toolbox and places them in an array
        let shape = Object.create(Shape);
        shape.init(box, 10, 10, 60, 20, '#00f', 10000, 'stoker');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 40, 80, 30, '#00c', 15000, 'stoker');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 80, 100, 40, '#009', 20000, 'stoker');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 130, 60, 10, '#0f0', 12000, 'feeder');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 150, 80, 15, '#0c0', 16000, 'feeder');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 175, 100, 20, '#090', 20000, 'feeder');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 205, 20, 20, '#f00', 4000, 'tank' );
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 235, 40, 40, '#c00', 8000, 'tank' );
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 10, 285, 80, 80, '#c00', 12000, 'tank' );
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 220, 205, 20, 20, '#fff', 0, 'chimney');
        shapes.push(shape);
        shape = Object.create(Shape);
        shape.init(box, 160, 235, 80, 160, 'transparent', 0, 'door');
        shapes.push(shape);

        // Draw the shapes
        repeater(box, shapes);

        // make measurement button sensitive
        document.forms.inputpanel.bt1.addEventListener('click', drawRoom)
    }

    let drawRoom = function () {
        //Draw room, handler for click button
        let workDiv = document.getElementById('work');

        //Remove all children from an element
        while (workDiv.firstChild) {
            workDiv.removeChild(workDiv.firstChild);
        }
        cshapes = [];    // clear array for left canvas

        let roomCanvas = document.createElement('canvas'); // create canvas

        roomCanvas.setAttribute('id', 'room'); // give canvas 3 attributes
        roomCanvas.setAttribute('width', document.forms.inputpanel.wid.value);
        roomCanvas.setAttribute('height', document.forms.inputpanel.hei.value);
        workDiv.appendChild(roomCanvas); // attach to parent div

        room = Object.create(Canvas);
        room.init ('room', '#ee0'); // create object reference

        // make toolbox click sensitive
        box.canvas.addEventListener('click', select);
    }

    let redraw = function () {
        // clear canvas
        cv.clear();
        // prep canvas with background color
        cv.prep();
        // loop through the array and draw the shapes
        for (let i = 0; i < arr.length; i++) {
            arr[i].draw();
        }
    }

    let repeater = function(cv, arr) {
        // if this is an animation build a setInterval loop here
        // if not, just draw this once
        redraw(cv, arr);
    }


    let select = function(ev) {
        // for each array shape in the box
        // for each array shape in box
        for (var i = 0; i < shapes.length; i++) {
            let cx = shapes[i].ctx;  // get context from array obj
            cx.beginPath();          // simulate it's path
            cx.rect(shapes[i].x, shapes[i].y, shapes[i].width, shapes[i].height);
            cx.closePath();
            let mcoord = mouseToCanvasCoordinatesNML(ev);
            if (cx.isPointInPath(mcoord['x'], mcoord['y'])) {  // is this the hit shape?
                cx.lineWidth = 2;              // stroke weight
                cx.strokeStyle = 'black';       // stroke color
                cx.stroke();
                room.canvas.addEventListener('click', function placeInRoom(ev) {
                    redraw(box, shapes); // clear select in toolbox

                    let mcoord = mouseToCanvasCoordinatesNML(ev);
                    let cshape = Object.create(Shape);
                    cshape.init(room, mcoord['x'], mcoord['y'],
                        shapes[i].getWidth(), shapes[i].getHeight(),
                        shapes[i].getColor(),
                        shapes[i].getPrice(), shapes[i].getType());
                    for (let j = 0; j < cshapes.length; j++) {
                        if (cshape.isOverlapping(cshapes[j])) {
                            window.alert("overlaps another shape");
                            room.canvas.removeEventListener('click', placeInRoom);
                            return;
                        }
                        if (cshapes[j].getType() === cshape.getType()) {
                            window.alert("There's already a " + cshape.getType() + " in the room");
                            room.canvas.removeEventListener('click', placeInRoom);
                            return;
                        }

                    }
                    if (cshape.getType() === 'chimney' && !cshape.isChimneyRules()) {
                        window.alert("Chimney must be near wall");
                        room.canvas.removeEventListener('click', placeInRoom);
                        return;
                    }
                    if (cshape.getType() === 'door' && !cshape.isDoorRules()) {
                        window.alert("Door must be placed near wall");
                        room.canvas.removeEventListener('click', placeInRoom);
                        return;
                    }
                    if (!cshape.isFullyInsideRoom()) {
                        window.alert("Not fully inside room. Intersects wall.");
                        room.canvas.removeEventListener('click', placeInRoom);
                        return;
                    }
                    cshapes.push(cshape);
                    if (cshapes.length === 1) {
                        room.canvas.addEventListener('mousedown', mouseDowner);

                    }
                    redraw(room, cshapes);
                    room.canvas.removeEventListener('click', placeInRoom);
                    if (cshapes.length >= 3) {
                        document.forms.inputpanel.btf.addEventListener('click', calculate);
                    }
                });
                break;
            } else {
                continue;
            }
        }
    }

    let mouseToCanvasCoordinatesNML = function(e) {
        let coord = [];
        // bb = canvas x, y, w, h
        let bb = e.target.getBoundingClientRect();
        // mouse window coordinates to canvas coordinates
        coord['x'] = (e.clientX - bb.left) * (e.target.width / bb.width);
        coord['y'] = (e.clientY - bb.top) * (e.target.height / bb.height);
        return coord;
    }

    let calculate = function () {
        let s = "Estimate: \n \n";
        let sum = 0;
        for (let i = 0; i < cshapes.length; i++) {
            if (cshapes[i].getType() === 'chimney' ||
                cshapes[i].getType() === 'door') continue;
            s += ': '+cshapes[i].getType()+"\t"+cshapes[i].getPrice()+"\n";
            sum += cshapes[i].getPrice();
        }
        s += "\nTotal:\t" + sum;

        let container = document.getElementById('calculation');
        let calc = document.createElement('article');
        let outp = document.createElement('pre');
        let outpp = document.createTextNode(s);
        outp.appendChild(outpp);
        calc.appendChild(outp);
        container.appendChild(calc);
        document.forms.inputpanel.btx.removeEventListener('click', calculate);
    }

    let mouseDowner = function (ev) {
        for (let i = 0; i < cshapes.length; i++) {
            let cx = cshapes[i].ctx; // get context from array obj
            cx.beginPath(); // simulate it's path
            cx.rect(cshapes[i].x, cshapes[i].y, cshapes[i].width, cshapes[i].height);
            cx.closePath();
            let mcoord = mouseToCanvasCoordinatesNML(ev);
            if (cx.isPointInPath(mcoord['x'], mcoord['y'])) {   // is this the hit shape
                let offsetX = mcoord['x'] - cshapes[i].getX();
                let offsetY = mcoord['y'] - cshapes[i].getY();
                room.canvas.addEventListener('mousemove', function mouseMover(ev) {
                    room.canvas.addEventListener('mouseup', function () {
                        room.canvas.removeEventListener('mousemove', mouseMover);
                    });
                    let ccord = mouseToCanvasCoordinatesNML(ev);
                    let cshape = Object.create(Shape);
                    cshape.init(room,
                        ccord['x'] - offsetX,
                        ccord['y'] - offsetY,
                        cshapes[i].getWidth(), cshapes[i].getHeight(),
                        cshapes[i].getColor(),
                        cshapes[i].getPrice(), cshapes[i].getType());
                    for (let j = 0; j < cshapes[i].length; j++) {
                        if (i === j) continue;
                        if (!cshape.isOverlapping(cshapes[j]) && cshape.isFullyInsideRoom()) {
                            cshapes[i].move(cshape.getX(), cshape.getY());
                        }
                    }
                });
                break;
            }
        }
    }

    let shapes = [];
    let box;
    let cshapes = [];
    let room;

    window.addEventListener('load', initialize); */

</script>
<script src="{{ asset('js/nQuery.js') }}"></script>
<script src="{{ asset('js/nmlCanvas.js') }}"></script>
<script src="{{ asset('js/nmlShape.js') }}"></script>
<script src="{{ asset('js/config80.js') }}"></script>