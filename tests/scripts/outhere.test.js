/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



//const { isitsum } = require('./outhere.js');

console.log('gamma');
const { isitsum } = require('outhere.js');

//console.log( isitsum );
console.log('delta');
console.log( isitsum );

console.log('alpha');

function sumit(a, b) {
    return a + b;
}

//var a = isitsum(3, 7);

test('adds 1 + 2 to equal 3', 
() => {
    expect( sumit(1, 2) ).toBe(3);
    
    //expect( isitsum(1, 2) ).toBe(4);
});

