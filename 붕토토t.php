<html>
<head>
<title>붕토토 시뮬레이터</title>

<style>

img.character1{
	height:190px;
}

img.character2{
	height:190px;
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
}
</style>
</head>


<body>

<table background='./background.png' style="background-size:100% 100%;"><tr><td width=1080 height=549 style="vertical-align:top;">

<table style="width:100%;height:100%">

<tr>
	<td colspan=3 style="height:45%;background-color:rgba(255,255,255,0.6);"><div id='logarea' style="width:100%;height:230px;overflow:auto;font-size:14px;"><div style="font-size:50px;margin-left:300px;">붕토토 시뮬레이터</div></div></td>
</tr>
<tr>
	<td style="width:35%;height:35%;text-align:right"><span id='characterimage1'><img src="./Himeko.png" class='character1'></span></td><td></td><td style="width:35%;"><span id='characterimage2'><img src="./Himeko.png" class='character2'></span></td>
</tr><tr>
	<td style="text-align:right" id="selectarea1">
		<select name="player1" id="player1" style="width:150px;height:30px;font-size:20px;text-align:right;" onchange="javascript:ChangeCharacter(1)">
			<option value='Mei' style="direction:rtl;">메이</option>
			<option value='Kiana' style="direction:rtl;">키아나</option>
			<option value='Bronya' style="direction:rtl;">브로냐</option>
			<option value='Himeko' style="direction:rtl;">히메코</option>
			<option value='Judas' style="direction:rtl;">테레사</option>
			<option value='Fu_hua' style="direction:rtl;">후카</option>
			<option value='Kallen' style="direction:rtl;">카렌</option>
			<option value='Sakura' style="direction:rtl;">야에 사쿠라</option>
			<option value='Rita' style="direction:rtl;">리타</option>
			<option value='Rozaliya' style="direction:rtl;">로잘리아</option>
			<option value='Seele' style="direction:rtl;">제레</option>
		</select>
	</td><td style="text-align:center;"><span id='startbutton' class='startbutton'><img onclick="javascript:StartRound();" src="./start.png"></span></td>
	
	<td id="selectarea2">
		<select name="player2" id="player2" style="width:150px;height:30px;font-size:20px;text-align:left;" onchange="javascript:ChangeCharacter(2)">
			<option value='Mei'>메이</option>
			<option value='Kiana' >키아나</option>
			<option value='Bronya'>브로냐</option>
			<option value='Himeko' >히메코</option>
			<option value='Judas' >테레사</option>
			<option value='Fu_hua' >후카</option>
			<option value='Kallen' >카렌</option>
			<option value='Sakura' >야에 사쿠라</option>
			<option value='Rita'>리타</option>
			<option value='Rozaliya' >로잘리아</option>
			<option value='Seele' >제레</option>

		</select>
	</td>
</tr>
<tr>
	<td colspan=3 style="height:10%;"></td>
</tr>

</table>

</tr></td>
</table>


</body>


<script language="javascript">

var logturn=new Array(),loghp1=new Array(),loghp2=new Array(),logmsg=new Array();

var logn=0;

var TURN_INTERVAL=100;

var p1max=100;
var p2max=100;

ChangeCharacter(1);
ChangeCharacter(2);
function ChangeCharacter(slot){

	var sel=document.getElementById('player'+slot);
	document.getElementById('characterimage'+slot).innerHTML="<img src=\"./"+sel.options[sel.selectedIndex].value+".png\" class='character"+slot+"'>";

}

function StartRound(){

	
	var sel1=document.getElementById('player1');
	var sel2=document.getElementById('player2');

	alert("START:"+sel1.options[sel1.selectedIndex].value+" VS "+sel2.options[sel2.selectedIndex].value);
	window.location.href="https://"+location.hostname+"/Honkaitoto/%EB%B6%95%ED%86%A0%ED%86%A0.php?run=1&p1="+sel1.options[sel1.selectedIndex].value+"&p2="+sel2.options[sel2.selectedIndex].value;

}

function changeUI(char1,char2){
	var startbuttonspace=document.getElementById('startbutton');
	startbuttonspace.innerHTML="<a href=\"https://"+location.hostname+"/Honkaitoto/%EB%B6%95%ED%86%A0%ED%86%A0.php\">돌아가기</a><br>";
	startbuttonspace.innerHTML+="<a href=\"https://"+location.hostname+"/Honkaitoto/%EB%B6%95%ED%86%A0%ED%86%A0si.php?run=1&p1="+char1+"&p2="+char2+"\">1만번 시뮬 돌려보기</a><br>";
	
	var hpbar1=document.getElementById('selectarea1');
	var hpbar2=document.getElementById('selectarea2');

	hpbar1.innerHTML="<img src=\"./red.png\" style=\"height:10px;width:0px;\" id='hp1red'><img src=\"./green.png\" style=\"height:10px;width:200px;\" id='hp1green'><br><span id='p1hp'>100/100</span>";
	hpbar2.innerHTML="<img src=\"./green.png\" style=\"height:10px;width:200px;\" id='hp2green'><img src=\"./red.png\" style=\"height:10px;width:0px;\" id='hp2red'><br><span id='p2hp'>100/100</span>";

	var chrimage1=document.getElementById('characterimage1');
	var chrimage2=document.getElementById('characterimage2');
	chrimage1.innerHTML="<img src=\"./"+char1+".png\" class='character1'>";
	chrimage2.innerHTML="<img src=\"./"+char2+".png\" class='character2'>";

	document.getElementById('logarea').innerHTML="";
}

function InitRound(){

	setTimeout("RunRound()",TURN_INTERVAL);
	

}

function RunRound(){
	
	var logarea=document.getElementById('logarea');
	
	logarea.innerHTML=logarea.innerHTML+"TURN "+logturn[logn]+":"+logmsg[logn]+"<br>";

	if(loghp1[logn]<0)loghp1[logn]=0;
	if(loghp2[logn]<0)loghp2[logn]=0;
	document.getElementById('hp1green').style.width=loghp1[logn]*2;
	document.getElementById('hp1red').style.width=(100-loghp1[logn])*2;
	document.getElementById('p1hp').innerHTML=loghp1[logn]+"/"+p1max;
	document.getElementById('hp2green').style.width=loghp2[logn]*2;
	document.getElementById('hp2red').style.width=(100-loghp2[logn])*2;
	document.getElementById('p2hp').innerHTML=loghp2[logn]+"/"+p2max;
	

	if(logturn[logn]){
		logn++;
		setTimeout("RunRound()",TURN_INTERVAL);	
	}
}

</script>

<?php

function debugalert($message){

echo("<script>alert(\"".$message."\");</script>\n");
}
?>


<?php

$turntime;
$player1;
$player2;
$logs;
$logn=0;
$winner=0;

$winN=array(0,0);



class combatlog{

	public $message;
	public $hp1,$hp2;
	public $turn;

	function __construct($t,$h1,$h2,$m){
		$this->turn=$t;
		$this->message=$m;
		$this->hp1=$h1;
		$this->hp2=$h2;
	}

}



class Damage{

	public $p, $e, $t,$type,$message,$r,$times;
	function __construct($p,$e,$t,$tp){
		$this->p=$p;
		$this->e=$e;
		$this->t=$t;
		$this->type=$tp;
		$this->message="";
		$this->r=$p+$e+$t;
		$this->times=1;
	}
	
	
}

class Valkyrie {


	public $name, $s_hp, $s_atk, $s_arm, $s_spd, $hp,$stack,$debuff=array(0,0,0,0,0,0,0,0,0,0);

	function heal($h){
		$this->hp+=$h;

		if($this->hp>$this->s_hp){
			$this->hp=$this->s_hp;
		}
	}

/*
	function get_attacked($damage){
		o_get_attacked($damage);
	}

	function attack(){
		o_attack();
	}*/
	function o_attack(){
		
		$hitlog=new Damage($this->s_atk,0,0,0);
		$hitlog->message="기본 공격";
		return $hitlog;
	}



	function o_get_attacked($damage){

		$value=($damage->p)-$this->s_arm;

		if($value<0)$value=0;
		$value+=$damage->e+$damage->t;


		if($this->debuff[5]>0){
			$value=round($value*1.5);
		}
		else if($this->debuff[6]>0){
			$value=round($value*0.5);
		}


		$this->hp-=$value*$damage->times;
		if($this->hp<0 && $this->hp>-2000)$this->hp=0;

		$hitlog=new Damage($damage->p,$damage->e,$damage->t,$this->s_arm);
		$hitlog->times=$damage->times;
		$hitlog->r=$value*$damage->times;


		if($damage->type==1){
			//디버프 0번 (2턴간 공격력 하락)
			

			$hitlog->message="(2턴간 공격력 15 감소)";
			$this->get_debuff(0);	
			


		}

		else if($damage->type==2){
			//디버프 1,2번 (1턴간 스킬 사용 불가)
			

			$hitlog->message="(다음 턴 스킬 사용 불가)";
			$this->get_debuff(1);	
			


		}

		else if($damage->type==3){
			//공격 봉쇄 (리타)

			$hitlog->message="(얼음 감옥. 공격 불가)";
			$this->get_debuff(3);	
			


		}

		else if($damage->type==4){
			//연소(사쿠라)
			$hitlog->message="(적을 불태웠다. 3턴간 5데미지)";
			$this->get_debuff(4);	

		}

		else if($damage->type==5){
			//받는 데미지 50% 증가 디버프 (로잘리아)

			$hitlog->message="(로잘리아의 패시브로 다음 턴 공격력 50% 증가)";
			$this->get_debuff(5);	

		}

		else if($damage->type==6){
			//받는 데미지 50% 감소 디버프(버프?) (로잘리아)

			$hitlog->message="(로잘리아의 패시브로 다음 턴 공격력 50% 감소)";
			$this->get_debuff(6);	

		}

		$hitlog->r+=$burndamage->r;
		return $hitlog;

	}

	function get_debuff($n){
		
		if($n==0){
			//공격력을 15 하락시키는 디버프 공격 (카렌) 디버프 넘버 0
			$this->debuff[0]=4;
			
		}
		if($n==1&&$this->debuff[1]==0){
			//스킬 사용 불가 (메이) 디버프 넘버 1
			$this->debuff[1]=2;
			
		}
		else if($n==1&&$this->debuff[1]!=0){
			//스킬 사용 불가 (메이) 디버프 넘버 2
			$this->debuff[2]=2;
			
		}
		else if($n==3){
			//공격 불가(리타 얼음감옥)디버프 넘버 3
			$this->debuff[3]=2;
			
		}
		else if($n==4){
			//3턴 연소 (사쿠라) 디버프 넘버 4
			$this->debuff[4]=6;

		}
		else if($n==5){
			//받뎀증 (로잘리아) 디버프넘버5
			$this->debuff[5]=3;

		}
		else if($n==6){
			//받뎀감 (로잘리아) 디버프 넘버 6
			$this->debuff[6]=3;

		}
	}


	function count_debuff(){

		for($i=0;$i<sizeof($this->debuff);$i++){
			$this->debuff[$i]--;
			if($this->debuff[$i]<0){
				$this->debuff[$i]=0;
			}
		}

	}

}

class Himeko extends Valkyrie {

	function __construct(){
		$this->name="히메코";
		$this->s_hp=100;
		$this->s_atk=24;
		$this->s_arm=10;
		$this->s_spd=2;

		$this->hp=$this->s_hp;
		$this->stack=0;

	}

	function passive($n){
		if($n==1){
			$this->s_atk*=1.5;
			$this->s_arm*=1.5;
		}

		else{
			$this->s_atk*=2/3;
			$this->s_arm*=2/3;
		}
	}

	function attack(){


		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($buffed->hp<=40){
			$buffed->passive(1);
		}
		
		if($this->debuff[1]){
			$this->stack=0;
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}

		else if(mt_rand(1,10)>3 || $this->stack==1){
			
			if($this->stack){
				$this->stack=0;
				$hitlog=new Damage($buffed->s_atk,($buffed->s_atk*2),0,0);
				$hitlog->message="필살기";
				return $hitlog;
			}
			else

				$hitlog=$buffed->o_attack();
				
				return $hitlog;
		}
		else{

				$this->stack=1;
				$hitlog=new Damage(0,0,0,0);
				$hitlog->message="차지";
				return $hitlog;

		}
		
	}

	function get_attacked($damage){


		if($this->hp<=40){
			$this->passive(1);
			$hitlog=clone $this->o_get_attacked($damage);
			$this->passive(0);
		}
	
		else{
		$hitlog=clone $this->o_get_attacked($damage);
		}
	


		return $hitlog;
	}
	
}

class Fu_hua extends Valkyrie {



	function __construct(){
		$this->name="후카";
		$this->s_hp=100;
		$this->s_atk=27;
		$this->s_arm=8;
		$this->s_spd=10;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}
	

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}
		else if($GLOBALS['turntime']%3){
			
			return $buffed->o_attack();
		}
		else{
			$hitlog=new Damage(0,mt_rand(10,30),0,0);
			$hitlog->message="특수 공격";
			return $hitlog;
		}
		
	
	}

	function get_attacked($damage){





		if($this->stack==1){
			$damage->e=0;
		}

		$hitlog=clone $this->o_get_attacked($damage);

		if($this->stack==0 && $this->hp<=0 && $this->hp>-2000){
			$this->stack=1;
			$this->hp=1;
			$hitlog->message.="(불사 발동)";
		}


		return $hitlog;
	}
	
}

class Kallen extends Valkyrie{
		function __construct(){
		$this->name="카렌";
		$this->s_hp=100;
		$this->s_atk=26;
		$this->s_arm=6;
		$this->s_spd=10;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if(mt_rand(1,20)==2){
			$hitlog=new Damage(0,0,9999,0);
			$hitlog->message="폐인 공격";
			return $hitlog;
		}
		else if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}
		else if(mt_rand(1,10)<4){
			
			$hitlog=$buffed->o_attack();
			$hitlog->type=1;
			$hitlog->message="특수 공격";
			return $hitlog;
		}
		else{
			$hitlog=$buffed->o_attack();
			return $hitlog;

		}
		
	
	}
	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;
	}
}


class Kiana extends Valkyrie{
		function __construct(){
		$this->name="키아나";
		$this->s_hp=120;
		$this->s_atk=23;
		$this->s_arm=11;
		$this->s_spd=4;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}
		else if($GLOBALS['turntime']%3){
			$hitlog=$buffed->o_attack();
			return $hitlog;

		}

		else{
			$hitlog=new Damage(12,0,0,0);
			$hitlog->times=8;
			$hitlog->message="운석 소용돌이";
			return $hitlog;

		}

		
	
	}
	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;
	}
}

class Judas extends Valkyrie{
		function __construct(){
		$this->name="유다";
		$this->s_hp=100;
		$this->s_atk=24;
		$this->s_arm=8;
		$this->s_spd=5;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}
		else if($GLOBALS['turntime']%2){
			$hitlog=$buffed->o_attack();
			return $hitlog;

		}

		else{
			$rand4damage=mt_rand(1,16)+mt_rand(1,16)+mt_rand(1,16)+mt_rand(1,16);
			$hitlog=new Damage(0,$rand4damage,0,0);
			$hitlog->message="테레사 투척";
			return $hitlog;

		}

		
	
	}
	function get_attacked($damage){

		$reduced_damage=clone $damage;
		$reduced_damage->e=round($reduced_damage->e/2);
		$hitlog=clone $this->o_get_attacked($reduced_damage);
		return $hitlog;

	}
}

class Mei extends Valkyrie{
		function __construct(){
		$this->name="메이";
		$this->s_hp=100;
		$this->s_atk=26;
		$this->s_arm=6;
		$this->s_spd=6;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			$hitlog->e=5;
			return $hitlog;
		}

		else if(mt_rand(1,10)>7){
			$hitlog=new Damage($buffed->s_atk,20,0,2);
			$hitlog->message="천명참";
			return $hitlog;

		}
		else {
			$hitlog=$buffed->o_attack();
			$hitlog->e=5;
			return $hitlog;
		}


		
	
	}
	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;

	}
}

class Rita extends Valkyrie{
		function __construct(){
		$this->name="리타";
		$this->s_hp=100;
		$this->s_atk=26;
		$this->s_arm=8;
		$this->s_spd=6;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if(mt_rand(1,10)>7){
			$this->stack=1;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}

		else if(mt_rand(1,10)>8) {
			$hitlog=new Damage($buffed->s_atk,0,0,3);
			$hitlog->message="은빛 그림자";
			return $hitlog;
		}
		else {
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}


		
	
	}
	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;

	}
}

class Seele extends Valkyrie{
		function __construct(){
		$this->name="제레";
		$this->s_hp=100;
		$this->s_atk=23;
		$this->s_arm=10;
		$this->s_spd=10;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}
		else if($GLOBALS['turntime']%4){


			$hitlog=$buffed->o_attack();

			return $hitlog;

		}

		else{
			if(mt_rand(1,4)==1){

				$hitlog=new Damage(100,0,0,0);
				$hitlog->message="양자 붕괴";
				return $hitlog;
			}
			else{
				$hitlog=new Damage(0,0,0,0);
				$hitlog->message="양자 붕괴(Miss)";
				return $hitlog;
			}
		}

		

		
	
	}
	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;
	}
}



class Rozaliya extends Valkyrie{
		function __construct(){
		$this->name="로잘리아";
		$this->s_hp=100;
		$this->s_atk=30;
		$this->s_arm=4;
		$this->s_spd=8;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		$mtrand=mt_rand(1,20);
		if($mtrand<4){
			$buffed->stack=5;
		}
		else if($mtrand<7){
			$buffed->stack=6;
		}
		else $buffed->stack=0;

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			$hitlog->type=$buffed->stack;
			return $hitlog;
		}

		else if($GLOBALS['turntime']%3==0){
			$hitlog=new Damage(15,0,0,0);
			$hitlog->times=10;
			$hitlog->message="울랄라 타이푼";
			$this->stack=10;
			return $hitlog;

		}
		
		else{

			
			$hitlog=$buffed->o_attack();
			$hitlog->type=$buffed->stack;
			return $hitlog;

		}



		
	
	}
	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;
	}
}


class Bronya extends Valkyrie{
		function __construct(){
		$this->name="브로냐";
		$this->s_hp=100;
		$this->s_atk=26;
		$this->s_arm=8;
		$this->s_spd=2;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
			return $hitlog;
		}

		else if($GLOBALS['turntime']%3==0){
			$hitlog=new Damage(mt_rand(1,100),0,0,0);
			$hitlog->message="필살기";
			return $hitlog;
		}
		
		else{
			$hitlog=$buffed->o_attack();
			return $hitlog;

		}
	}


	function get_attacked($damage){

		if(mt_rand(1,20)<4 && $damage->message!="연소"){
			$hitlog=new Damage(0,0,0,0);
			$hitlog->message="브로냐가 공격을 회피했다.";	
		}

		else $hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;

	}
}

class Sakura extends Valkyrie{
		function __construct(){
		$this->name="야에 사쿠라";
		$this->s_hp=100;
		$this->s_atk=28;
		$this->s_arm=7;
		$this->s_spd=8;

		$this->hp=$this->s_hp;
		$this->stack=0;
	}

	function attack(){
		
		$buffed=clone $this;

		if($buffed->debuff[0]){
			$buffed->s_atk-=15;
		}

		if($this->debuff[1]){
			$hitlog=$buffed->o_attack();
		}

		else if(mt_rand(1,4)==1){
			$hitlog=$buffed->o_attack();
			$hitlog->times=2;
			$hitlog->message="필살기";
		}
		
		else{
			$hitlog=$buffed->o_attack();
		}
		if(mt_rand(1,5)==1){
			$hitlog->type=4;
		}

		return $hitlog;
	}


	function get_attacked($damage){

		$hitlog=clone $this->o_get_attacked($damage);
		return $hitlog;

	}
}


function run_attack($pp1,$pp2){
	
	global $logs,$logn,$turntime,$player1,$player2;

	if($pp1->debuff[3]==0){
		
		if($pp1->name=="로잘리아"&&$pp1->stack==10){
			$pp1->stack=0;
			$logs[$logn]=new combatlog($turntime,$player1->hp,$player2->hp,$pp1->name."는 울랄라 타이푼의 후폭풍으로 어지럼증에 빠져 있다.");

			$logn++;

		}
		else{

		$attackdamage=$pp1->attack();
		$getdamage=$pp2->get_attacked($attackdamage);
		
		if($pp1->name=='리타' && $pp1->stack==1){
			$bhp=$pp1->hp;

			$pp1->heal($getdamage->r);

			$ahp=$pp1->hp;

			$getdamage->message.="(흡혈.hp:".$bhp."->".$ahp.")";
			$pp1->stack=0;
		}
		
		if($pp1->name=='로잘리아' && $pp2->name=='브로냐' && $getdamage->r==0){
			$getdamage->r=0;
		}


		$logs[$logn]=new combatlog($turntime,$player1->hp,$player2->hp,$pp1->name." 이(가) ".$attackdamage->message."(으)로 ".$pp2->name."에게 ".$getdamage->r." 데미지.".$getdamage->message);

		$logn++;
		}
	}


	else{
		if($pp1->name=="히메코" || $pp1->name=="로잘리아"){
			$pp1->stack=0;
		}
		$logs[$logn]=new combatlog($turntime,$player1->hp,$player2->hp,$pp1->name."은(는) 얼음 감옥에 갇혀 있다.");

		$logn++;
	
	}
	if($pp1->name=="제레")
	{
		
		$pp1->heal(7);
		$logs[$logn]=new combatlog($turntime,$player1->hp,$player2->hp,$pp1->name."의 체력 회복 7(현재 체력:".$pp1->hp.").");
		$logn++;

	}
	if($pp2->debuff[4]>0){
		$burn=new Damage(0,5,0,0);
		$burn->message="연소";
		$getdamage=$pp2->get_attacked($burn);

		$logs[$logn]=new combatlog($turntime,$player1->hp,$player2->hp,$pp2->name."은(는) 연소 데미지를 ".$getdamage->r." 입었다.");
		$logn++;

	}
		$pp1->count_debuff();
		$pp2->count_debuff();
		check_game();
}


function play_round($turn){
	global $player1,$player2;
	global $logs,$logn,$winner;

	if($logn>100)$logn=0;

	if($player1->s_spd >= $player2->s_spd){

		run_attack($player1,$player2);

		if(!$winner) run_attack($player2,$player1);
	}


	else{
		
		run_attack($player2,$player1);

		if(!$winner) run_attack($player1,$player2);
		
		}
	
}


function check_game(){

	global $player1,$player2;
	global $logs,$turntime,$winner,$logn;

	if($player1->hp <=0){
		
		$winner=2;
		$logs[$logn]=new combatlog(0,$player1->hp,$player2->hp,$player2->name." 승리.");
		$logn++;
	}
	else if($player2->hp <=0){
		
		$winner=1;
		$logs[$logn]=new combatlog(0,$player1->hp,$player2->hp,$player1->name." 승리.");
		$logn++;
	}
}


function SetValkyrie($name){
	switch($name){
		case 'Himeko':
			$Valkyrie=new Himeko();
			break;
		case 'Fu_hua':
			$Valkyrie=new Fu_hua();
			break;
		case 'Kallen':
			$Valkyrie=new Kallen();
			break;
		case 'Kiana':
			$Valkyrie=new Kiana();
			break;
		case 'Judas':
			$Valkyrie=new Judas();
			break;
		case 'Mei':
			$Valkyrie=new Mei();
			break;
		case 'Rita':
			$Valkyrie=new Rita();
			break;
		case 'Seele':
			$Valkyrie=new Seele();
			break;
		case 'Rozaliya':
			$Valkyrie=new Rozaliya();
			break;
		case 'Bronya':
			$Valkyrie=new Bronya();
			break;
		case 'Sakura':
			$Valkyrie=new Sakura();
			break;
	}

	return $Valkyrie;

}

if($_GET['run']>0){


	echo("<script language='javascript'>changeUI(\"".$_GET['p1']."\",\"".$_GET['p2']."\");</script>");

	$player1=SetValkyrie($_GET['p1']);
	$player2=SetValkyrie($_GET['p2']);

	if($_GET['p1']=="Kiana"){
		echo("<script language='javascript'>p1max=120;</script>");
	}
	if($_GET['p2']=="Kiana"){
		echo("<script language='javascript'>p2max=120;</script>");
	}

	for($j=0;$j<$_GET['run'];$j++){
		for($turntime=1;$winner==0&&$turntime<30;$turntime++){
			play_round($turntime);
		}

		$player1=SetValkyrie($_GET['p1']);
		$player2=SetValkyrie($_GET['p2']);


		$winN[$winner-1]++;
		$winner=0;
	}



if($_GET['run']==1){


	echo("<script language='javascript'>\n ");

	for($i=0;$i<$logn;$i++){
		echo("logturn[".$i."]=".$logs[$i]->turn."; \n");
		echo("loghp1[".$i."]=".$logs[$i]->hp1."; \n");
		echo("loghp2[".$i."]=".$logs[$i]->hp2."; \n");
		echo("logmsg[".$i."]=\"".$logs[$i]->message."\"; \n");
	}
	
	echo("setTimeout(\"InitRound()\",100);\n");
	
	
	echo("</script>");

}
else if($_GET['run']>2){
	debugalert($player1->name." vs ".$player2->name." ".$winN[0]." : ".$winN[1]);
}


}

?>
</html>