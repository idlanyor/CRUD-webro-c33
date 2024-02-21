let array = 'VELLA ANGGRAENI'.replace(' ', '').split('')
class Sorting {
    constructor(arr) {
        this.arr = arr
    }
    insertionSort() {
        for (let i = 1; i < this.arr.length; i++) {
            let key = this.arr[i]
            let j = i - 1
            while (j >= 0 && this.arr[j] > key) {
                this.arr[j + 1] = this.arr[j]
                j = j - 1
            }
            this.arr[j + 1] = key
        }
        return this.arr
    }
    bubbleSort() {
        for (let i = 0; i < this.arr.length - 1; i++) {
            for (let j = 0; j < this.arr.length - i - 1; j++) {
                if (this.arr[j] > this.arr[j + 1]) {
                    [this.arr[j], this.arr[j + 1]] = [this.arr[j + 1], this.arr[j]]
                }
            }
        }
        return this.arr
    }
    selectionSort() {
        for (let i = 0; i < this.arr.length - 2; i++) {
            let minIndex = i;
            for (let j = i + 1; j < this.arr.length - 1; j++) {
                if (this.arr[j] < this.arr[minIndex]) {
                    minIndex = j
                }
            }
            if (minIndex != i) {
                [this.arr[i], this.arr[minIndex]] = [this.arr[minIndex], this.arr[minIndex]]
            }
        }
        return this.arr
    }
    static Merge(kanan, kiri) {
        let gabungan = []
        let i = 0, j = 0
        while (i < kanan.length && j < kiri.length) {
            // a. Jika leftArr[i] <= rightArr[j], tambahkan leftArr[i] ke hasil dan naikkan i.
            if (kanan[i] <= kiri[j]) {
                gabungan.push(kanan[i])
                i++
            } else {
                gabungan.push(kiri[j])
                j++
            }
        }
        while (i < kanan.length) {
            gabungan.push(kanan[i])
            i++
        }
        while (j < kiri.length) {
            gabungan.push(kiri[j])
            j++
        }
        return gabungan;
    }
    MergeSort() {
        if (this.arr.length <= 1) return this.arr;
        let tengah = Math.floor(this.arr.length / 2)
        let kanan = this.arr.slice(0, tengah)
        let kiri = this.arr.slice(tengah)
        let sortedKanan = new Sorting(kanan).MergeSort()
        let sortedKiri = new Sorting(kiri).MergeSort()
        return Sorting.Merge(sortedKanan, sortedKiri)

    }
}
console.info('Sebelum disorting :')
console.info(array)

console.info('Setelah disorting :')
let sortedArray = new Sorting(array)
console.info("Insertion Sort : ", sortedArray.insertionSort())
console.info("Bubble Sort : ", sortedArray.bubbleSort())
console.info("Selection Sort : ", sortedArray.selectionSort())
console.info("Merge Sort : ", sortedArray.MergeSort())