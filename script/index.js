var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');
var color = document.getElementById('tag');
var details = document.getElementById('details');

//화면 크기에 따른 canvas의 크기 변경
var scale = 1;
window.addEventListener('resize', function () {
    var wScale = (window.innerWidth-40) / 1280;
    var hScale = (window.innerHeight-40) / 654;
    if (wScale < 1 || hScale < 1) {
        scale = Math.min(wScale, hScale);
        $('#canvas').width(1280 * scale);
        $('#canvas').height(654 * scale);
    } else {
        scale = 1;
        $('#canvas').width(1280 * scale);
        $('#canvas').height(654 * scale);
    }
});
window.onload = function () {
    var wScale = (window.innerWidth-40) / 1280;
    var hScale = (window.innerHeight-40) / 654;
    if (wScale < 1 || hScale < 1) {
        scale = Math.min(wScale, hScale);
        $('#canvas').width(1280 * scale);
        $('#canvas').height(654 * scale);
    }
}

canvas.addEventListener('mousemove', pick);
canvas.addEventListener('click', goto);
canvas.addEventListener('mouseout', redrawW);

var loop;
var alpha = 0.02;
var repeat = 1.0 / alpha;
var count = 0;

//페이지 새로고침 시 canvas fadein
var worldImg = new Image();
worldImg.src = "img/world.png";
worldImg.onload = function () {
    loop = setInterval(fadein, 13);
}
//canvas fadein
function fadein() {
    if (count > repeat) {
        clearInterval(loop);
        count = 0;
        ctx.globalAlpha = 1;
        ctx.clearRect(0, 0, 1280 * scale, 654 * scale);
        draw();
    } else {
        ctx.globalAlpha = alpha;
        ctx.drawImage(worldImg, 0, 0, 1280 * scale, 654 * scale);
        count++;
    }
}

//세계지도 그리기
function draw() {
    ctx.globalAlpha = 1;
    ctx.drawImage(worldImg, 0, 0, 1280, 654);
}

//세계지도 보여줄 때 worldmap 메세지 추가
function redrawW() {
    while (loopI.length != 0) {
        clearInterval(loopI.pop());
    }
    draw();
    setTags("world map");
	canvas.style.cursor = "default";
}

//대륙별 설명 및 이름 설정
function setTags(name) {
    details.hidden;
    color.innerHTML = name;
    checkNow = name;
    switch (name) {
        case "world map":
            details.innerHTML = "세계의 다양한 나라들의 정보를 얻을 수 있습니다. <br> 대륙 이미지에 마우스를 올려보세요.";
            checkNow = "";
            break;
        case "north_america":
            details.innerHTML = "북아메리카는 면적순으로 세번째로 넓은 면적을 차지하는 대륙이다.<br>인구수는 네번째로 많으며, 캐나다, 미국, 멕시코 등의 나라가 있다.";
            break;
        case "south_america":
            details.innerHTML = "남아메리카는 면적순으로 네번째로 넓은 면적을 차지하는 대륙이다.<br>인구수는 5번째로 많으며, 우루과이, 칠레, 브라질 등의 나라가 있다.";
            break;
        case "oceania":
            details.innerHTML = "오세아니아는 호주, 뉴질랜드와 파푸아섬, 그리고 미국의 하와이주를 포함한 크고 작은 섬들을 포함하는 대륙이다.";
            break;
        case "africa":
            details.innerHTML = "아프리카는 면적순으로 두번째로 넓은 면적을 차지하는 대륙이다.<br>총 55개국이 포함되어 있으며, 이에는 마다가스카르, 모로코, 이집트 등의 나라가 포함된다.";
            break;
        case "europe":
            details.innerHTML = "유럽은 약 50개국의 나라로 이루어져있다.<br>유럽에 속한 나라 중 가장 많은 인구를 가지는 나라는 러시아이며, 바티칸 시국이 가장 적은 인구를 가진다.";
            break;
        case "asia":
            details.innerHTML = "아시아는 가장 넓은 면적을 차지하는 대륙이며, 전체 인구의 60%정도가 아시아에 거주한다.<br>한국, 인도, 터키 등의 나라가 아시아에 포함된다. ";
        default:
            break;
    }

}

//색상 값을 가져와 대륙 위에 있는지, 배경에 있는지 판별
function pick(event) {
    var x = event.layerX;
    var y = event.layerY;
    var data = ctx.getImageData(x / scale, y / scale, 1, 1).data;
    if (data[0] > 10 && data[1] > 10 && data[2] > 10) {
        checkC(x, y);
    } else if (data[0] == 0 && data[1] == 0 && data[2] == 0) {
        if (checkNow != "") {
            redrawW();
        }
    }
}

//checkNow = 지금 표시되어있는 나라(세계지도일 경우 "")
var checkNow = "";
//마우스 위치에 따라 대륙의 범위 계산하여 설정
function checkC(x, y) {
    if ((x / scale * (-1) * 515 / 695 + 515) >= y / scale) {
        //북아메리카
        if (checkNow != "north_america") {
            draw();
            drawI("img/northA.png", 0, 0, 600, 370);
            setTags("north_america");
        }
		canvas.style.cursor = "pointer";
    } else if (x / scale < 455) {
        //남아메리카
        if (checkNow != "south_america") {
            draw();
            drawI("img/southA.png", 200, 315, 227, 339);
            setTags("south_america");
        }
		canvas.style.cursor = "pointer";
    } else if (x / scale <= 1280 && y / scale <= 654 &&
        (x / scale * (-339) / 360 + 1454) <= y / scale &&
        x / scale >= 920 && y / scale >= 315) {
        //오세아니아
        if (checkNow != "oceania") {
            draw();
            drawI("img/oceania.png", 1090, 390, 190, 264);
            setTags("oceania");
        }
		canvas.style.cursor = "pointer";
    } else if (x / scale >= 455 && y / scale >= 204 &&
        (y / scale > 335 || x / scale <= 635 ||
            x / scale * 131 / 155 - 332 <= y / scale) &&
        x / scale <= 840 && y / scale <= 654) {
        //아프리카
        if (checkNow != "africa") {
            draw();
            drawI("img/africa.png", 501, 201, 320, 365);
            setTags("africa");
        }
		canvas.style.cursor = "pointer";
    } else if (x / scale >= 535 && x / scale <= 788.961 &&
        y / scale >= 0 && y / scale <= 216.058) {
        //유럽
        if (checkNow != "europe") {
            draw();
            drawI("img/europe.png", 540, 0, 380, 265);
            setTags("europe");
        }
		canvas.style.cursor = "pointer";
    } else {
        //아시아
        if (checkNow != "asia") {
            draw();
            drawI("img/asia.png", 660, 0, 620, 430);
            setTags("asia");
        }
		canvas.style.cursor = "pointer";
    }
}

var loopI = new Array();
var alphaI = 0.02;
var countI = 0;
var repeatI = 1.0 / alphaI;
//대륙 색상 fadeIn
function drawI(what, x, y, w, h) {
    while (loopI.length != 0) {
        clearInterval(loopI.pop());
    }
    countI = 0;
    draw();
    var img = new Image();
    img.src = what;
    img.onload = function () {
        loopI.push(setInterval(function () {
            if (countI > repeatI) {
                while (loopI.length != 0) {
                    clearInterval(loopI.pop());
                }
                ctx.globalAlpha = 1;
                ctx.drawImage(img, x, y, w, h);
            } else {
                ctx.globalAlpha = alphaI;
                ctx.drawImage(img, x, y, w, h);
                count++;
            }
        }, 11));
    }
}

//대륙 페이지로 이동
function goto() {
    if (checkNow != "") {
        location.href = "http://onesteptrip.dothome.co.kr/continents/function/continent_detail.php?continent=" + checkNow;
    }
}