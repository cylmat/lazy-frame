/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//const sum = require('../build/js/outhere');

function sum(a, b) {
  return a + b;
}

test('adds 1 + 2 to equal 3', 
() => {
    expect( sum(1, 2) ).toBe(3);
});