<?php

namespace App\Src;

class BinarySearch
{
    public function __construct()
    {
        $sortedArray = [2, 5, 8, 12, 16, 23, 38, 56, 72, 91];
        $targetValue = 16;
        $left = 0;
        $right = count($sortedArray) - 1;
        $resultIndex = $this->binarySearchRecursive($sortedArray, $targetValue, $left, $right);
        if ($resultIndex !== -1) {
            print_r('The result is'.$resultIndex);
        } else {
            print_r('The result is null');
        }
    }

    public function binarySearchRecursive($arr, $target, $left, $right)
    {
        if ($left > $right) {
            // Target value not found in the array
            return -1;
        }
        $mid = floor(($left + $right) / 2);
        // Check if the target value is found at the middle index
        if ($arr[$mid] === $target) {
            return $mid;
        }
        // If the target is greater, search the right half
        if ($arr[$mid] < $target) {
            return $this->binarySearchRecursive($arr, $target, $mid + 1, $right);
        }

        // If the target is smaller, search the left half
        return $this->binarySearchRecursive($arr, $target, $left, $mid - 1);
    }
}
