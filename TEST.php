<?php

3. SQL-запросы для получения данных:
*********************************************

  a. Для заданного списка товаров получить названия всех категорий, в которых представлены товары;

SELECT DISTINCT CATEGORIES.name FROM CATEGORIES
    LEFT JOIN PRODUCTS ON PRODUCTS.category_id = CATEGORIES.id
    WHERE PRODUCTS.ID IN(4,5)

*если выборку делать не по списку айдишек товаров, а по их названиям, то можно соотвественно:

SELECT DISTINCT name FROM CATEGORIES 
	WHERE id IN (SELECT category_id FROM PRODUCTS 
	WHERE name IN ('Белая рубашка W1', 'Синяя рубашка B3'))
	
	
b) Для заданной категории получить список предложений всех товаров из этой категории и ее дочерних категорий;


SELECT products.id, products.name FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    WHERE products.category_id = '4'
UNION
SELECT products.id, products.name FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    WHERE products.category_id IN(SELECT id FROM categories WHERE parent_id = '4')


c) Для заданного списка категорий получить количество предложений товаров в каждой категории;
  
SELECT categories.name, COUNT(products.category_id) products_count FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    WHERE products.category_id IN('3','4','5') GROUP BY category_id
	

d) Для заданного списка категорий получить общее количество уникальных предложений товара;

SELECT SUM(products_count) unique_products_sum FROM (
    SELECT ptc.category_id, COUNT(id) products_count FROM products ptc
    WHERE ptc.category_id IN('3','4','5')
    AND ptc.id NOT IN (
    SELECT sub_ptc.id FROM products sub_ptc
    WHERE sub_ptc.category_id IN('3','4','5') AND sub_ptc.category_id != ptc.category_id
    )
    GROUP BY category_id
    ) t1	
	
e) Для заданной категории получить ее полный путь в дереве (breadcrumb, «хлебные крошки»).
  

SELECT name FROM categories
	WHERE id in (SELECT parent_id FROM categories 
	WHERE id in (SELECT parent_id FROM categories	
	WHERE id in (SELECT parent_id FROM categories 
	WHERE id = 4)))
UNION
SELECT name FROM categories
	WHERE id in (SELECT parent_id FROM categories  
	WHERE id in (SELECT parent_id FROM categories 
	WHERE id = 4))
UNION
SELECT name FROM categories 
	WHERE id in (SELECT parent_id FROM categories 
	WHERE id = 4)
UNION	
SELECT name FROM categories 
	WHERE id = 4	

*******************************************************************************************

Задание 3. Написать скрипт, который позволит создавать очередь LIFO используя только PHP.

function LIFOqueue(){
	$numargs = func_num_args();
	$stack = new SplStack();
	$i = 0;
	if($numargs){
		while($i < $numargs){
			$el = func_get_arg($i++);
			$stack->push($el);
			echo $el.'<br>';			
		}
	}
	
	echo 'Count: '         . $stack->count() .'<br>';	
	echo 'First element: ' . $stack->top() .'<br>'; 
	echo 'Last element:  ' . $stack->bottom() .'<br>'; 
	echo 'Serializing: '   . $stack->serialize() .'<br>';
		
}

LIFOqueue('one','two','three','four','five');


*******************************************************************

Задание 4. Переливка данных БД.


1. В таком случае желательно делать переливку не через phpAdminer и т.д. - а чере консоль
- так как длительное время выполнения операции однозначно будет сопровождаться обрывом процесса.
2.Сделать резервную копию базы С2 перед началом работы.
3. Чтобы не было коллизий с id - лучше перечислить нужные поля в С1 и С2, чтобы вставлять новые 
(которых нету в таблице С2) без id, а формирование id возложить на триггер у целевой таблицы (в данном случае С2).
4. В таком случае целесообразно также использовать игнорирование ошибок при вводе данных (так как сервер живой и на нем паралельно 
идут обновления - чтобы его работа не была остановлена вследвие како-то случайной критической ошибки).
 
 
********************************************************************
    ++++++++++++++  Дополнительные  задания   ++++++++++++++
********************************************************************
		   
Задание  1
Разработать php-скрипт,  отображающий сам себя без использования функций чтения файлов.

function superScript(){
	$innerText = 'I am super secret php-script!';
	highlight_file(__FILE__);
}

********************************************************************
Задание  2
Разработать javascript-функцию преобразования числа в его текстовое представление (26 => “двадцать шесть”), входящее число находится в диапазоне 1..9999.



function transformation(){
	aTens = [ "двадцать", "тридцать", "сорок", "пятдесят", "шестдесят", "Seventy", "Eighty", "Ninety"];
	aOnes = [ "Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
	"Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", 
	"Nineteen" ];
	function ConvertToHundreds(num){
		var cNum, nNum;
		var cWords = "";
		num %= 1000;
		if (num > 99) {
			/* Hundreds. */
			cNum = String(num);
			nNum = Number(cNum.charAt(0));
			cWords += aOnes[nNum] + " Hundred";
			num %= 100;
			if (num > 0)
			cWords += " and "
		}

		if (num > 19) {
		/* Tens. */
		cNum = String(num);
		nNum = Number(cNum.charAt(0));
		cWords += aTens[nNum - 2];
		num %= 10;
		if (num > 0)
			cWords += "-";
		}
		if (num > 0) {
			/* Ones and teens. */
			nNum = Math.floor(num);
			cWords += aOnes[nNum];
		}
			return cWords;
		}
	function ConvertToWords(num){
		if(num == ""){
			alert("enter num")
			return
		}
	var aUnits = [ "Thousand", "Million", "Billion", "Trillion", "Quadrillion" ];
	var cWords = (num >= 1 && num < 2) ? "Dollar and " : "Dollars and ";
	var nLeft = Math.floor(num);
	for (var i = 0; nLeft > 0; i++) { 
	if (nLeft % 1000 > 0) {
	if (i != 0)
	cWords = ConvertToHundreds(nLeft) + " " + aUnits[i - 1] + " " + cWords;
	else
	cWords = ConvertToHundreds(nLeft) + " " + cWords;
	}
	nLeft = Math.floor(nLeft / 1000);
	}
	num = Math.round(num * 100) % 100;
	if (num > 0)
	cWords += ConvertToHundreds(num) + " Cents";
	else
	cWords += "Zero Cents";

	document.getElementById("divVal").innerHTML = cWords
	return cWords;
	}
}

 //example

console.log(num_letters(9999));	
	
	
	