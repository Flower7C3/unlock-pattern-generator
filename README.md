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

Initial view:

    [3][5][3]
    [5][8][5]
    [3][5][3]

First point:

    (1)[4][3]
    [4][7][5]
    [3][5][3]

Second point:

    (1)(2)[2]
    [3][6][4]
    [3][5][3]

Third point:

    (1)(2)[1]
    [3][5](3)
    [3][4][2]
