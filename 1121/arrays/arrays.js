// ===================== Array exercise ==============================

let people = ["Greg", "Mary", "Devon", "James"];

// 1 - Using a loop, iterate through this array and console.log all of the people.

// for (i = 0; i < people.length; i++) {
//    console.log(people[i]);
// }

// 2 - Remove "Greg" from the array.

people.shift();
console.log(people);


// 3 - Remove "James" from the array.

console.log(people.pop());
console.log(people)

// 4 - Add "Matt" to the front of the array.

people.unshift("Matt");
console.log(people);

// 5 - Add Scott to the end of the array.

people.push("Scott");
console.log(people);

// 6 - Using a loop, iterate through this array and after console.log-ing "Mary", exit from the loop.

for (i = 0; i < 2; i++) {
   console.log(people[i]);
}

// 7 - Make a copy of the array using slice. The copy should NOT include "Mary" or "Matt".

newArray = people.slice(2)
console.log(newArray);

// 8 - Get the indexOf where "Mary" is located in the people array;

console.log(people.indexOf("Mary"));

// 9 - Create a new variable called withYourname and set it equal to the people array concatenated
//     with the string of "Your name".

withYourname = "Your name " + people;
console.log(withYourname);

// 10 - Given an array of numbers, double each number
{
   const numbers = [1, 2, 3, 4, 5];

   for (i = 0; i < numbers.length; i++) {
      numbers[i] *= 2;
   }
   console.log(numbers);
}

// 11 - Convert an array of names to uppercase
{
   const names = ["John", "Alice", "Bob"];

   // for (var i = 0; i < names.length; i++) {
   //    names[i].toUpperCase();
   // }

   names.toString().toUpperCase();
   console.log(names.toString().toUpperCase());
}

// 12 - Convert an array of temperatures in Celsius to Fahrenheit
// formula: Celsius × 9/5 + 32
{
   const temperatures = [0, 25, 50, 100];

   for (i = 0; i < temperatures.length; i++) {
      temperatures[i] *= 9 / 5;
      temperatures[i] += 32;
   }
   console.log(temperatures);
}


// 13 - Given an array of strings, create a new array containing the lengths of each string.
{
   const strings = ["hello", "world", "wcoding"];
   strLength = [];
   for (i = 0; i < strings.length; i++) {
      strLength.push(strings[i].length);
   }
   console.log(strLength);

}


// 14 - Given an array of numbers, filter out the even numbers.
{
   const numbers1 = [1, 2, 3, 4, 5];
   let oddArray = []
   for (i = 0; i < numbers1.length; i++) {
      if (numbers1[i] % 2 === 0) {
         oddArray.push(numbers1[i])
      }
   }
   console.log(oddArray);

}

// 15 - Filter out long words from an array of strings, keeping only the strings with a length less than or equal to 5 
{
   const words = ["apple", "banana", "kiwi", "melon", "pie"];
   shortWords = []
   for (i = 0; i < words.length; i++) {
      if (words[i].length <= 5) {
         shortWords.push(words[i]);
      }
   }
   console.log(shortWords);

   const shortWords2 = words.filter((word) => word.length <= 5);
   console.log(shortWords2);

}

// 16 - Filter out names that start with the letter "A" from an array of names using filter().
{
   const names = ["Alice", "Bob", "Anna", "Alex"];

   const onlyA = names.filter((name => name.includes("A")));

   console.log(onlyA);


}

// 17 - Check if all numbers in an array are positive using every().
{
   const numbers = [1, 2, -4, 3, 6, -10, 9];

   function isPositive(element, index, array) {
      return element > 0;
   }

   numbers.every(isPositive);
   console.log(numbers.every(isPositive));

}

// 18 - Check if all strings in an array have a length greater than 3 using every().
{
   const strings1 = ["hello", "world", "JavaScript"];
   function isLong(element, index, array) {
      return element.length > 3;
   }

   strings1.every(isLong);
   console.log(strings1.every(isLong));
}

// 19 - Check if all elements of an array are even numbers using every().
{
   const numbers = [2, 4, 6, 8, 10];

   function isEven(element, index, array) {
      return element % 2 === 0;
   }

   numbers.every(isEven);
   console.log(numbers.every(isEven));
}

// 20 - Check if all names in an array start with the letter "J" using every().
{
   const names1 = ["John", "Jane", "James"];

   function startsJ(element, index, array) {
      return element.includes("J");
   }

   names1.every(startsJ);
   console.log(names1.every(startsJ));

}

// 21 - Calculate the sum of all numbers in an array using
{
   const numbers2 = [1, 2, 3, 4, 5, 6, 7];
   sumNumbers2 = 0;

   for (i = 0; i < numbers2.length; i++) {
      sumNumbers2 += numbers2[i];
   }
   console.log(sumNumbers2);
}

