Unlock pattern generator
======

Test in console `php matrix.php`.


## Case

Generate random unlock pattern.


## Solution

1. Generate square matrix _n*n_ with points.
2. Find possible escapes foreach points. Escape is nearest free point.
3. Generate _m_ pattern points:
    * First is random point on matrix.
    * Every next is randomly selected from nearest points by weight score.
      Weight is number of possible escapes of every point.


## Example

Tip: in square brackets is printed number of possible escapes of point, in round bracket is printed point no.

Step 1

    [3][4][2]
    [5][7](1)
    [3][4][2]

Step 2

    [2][3][1]
    [4](2)(1)
    [2][3][1]

Step 3

    (3)[2][1]
    [3](2)(1)
    [2][3][1]

Step 4

    (3)[1][1]
    (4)(2)(1)
    [1][2][1]

Step 5 - final

    (3)[1][1]
    (4)(2)(1)
    [0](5)[0]
