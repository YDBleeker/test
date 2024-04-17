<?php

test('sum', function () {
    function sum($a, $b)
    {
        return $a + $b;
    }

    $result = sum(1, 2);
    $this->assertSame(3, $result);
});
