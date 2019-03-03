var cube, fill, square;

square = function(x) {
  return x * x;
};

cube = function(x) {
  return square(x) * x;
};

fill = function(container, liquid = "coffee") {
  return `Filling the ${container} with ${liquid}...`;
};
