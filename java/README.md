Hi Mas Satrio, 

I want to follow-up our application through our career page before. Thank you for your interest in this position anyway :)

Here's a test item that you need to do as the first step of the selection as Software Engineer in Bukalapak: 

https://gist.github.com/xinuc/b34ef9fc1a078ee4b2a6 



Berikut ini adalah sebuah implementasi struktur data Stack:

import java.util.ArrayList;
public class Stack {

    private int size;
    private int maxSize;

    private final ArrayList<Object> list;

    public Stack(int size) {
        this.size = 0;
        this.maxSize = size;
        this.list = new ArrayList<Object>(size);
    }

    public boolean push(Object o) {
        if (size >= maxSize) {
            return false;
        }

        this.list.add(0, o);
        this.size++;
        return true;
    }

    public Object pop() {
        Object o;
        if (this.size == 0) {
            return null;
        }

        o = this.list.remove(0);
        this.size--;
        return o;
    }

    public int size() {
        return this.size;
    }
}
kita akan menggunakan struktur data Stack tersebut sebagai berikut:

final Stack stack = new Stack(4);
for(int i = 0; i < 10000; i++) {
    final String data = "hello " + i;
    final int x = i;
    new Thread(new Runnable() {
        public void run() {
            if(x % 2 == 0) {
                System.out.println(stack.push(data));
            } else {
                System.out.println(stack.pop());
            }
        }
    }).start();
}
di mana kita membuat 10000 thread untuk memanipulasi object Stack tersebut.

stack.push boleh menghasilkan true (jika stack belum penuh) atau false (jika stack sudah penuh).

stack.pop boleh menghasilkan null jika memang stack sudah kosong.

Pertanyaan:

1.Jelaskan apa yang salah dalam implementasi struktur data Stack tersebut, dan bagaimana seharusnya.

-Stack ini dipake di banyak thread maka ada kemungkinan masuk race condition,
klo multithread maka kode yang sama bisa dijalankan bareng, kita nggak bisa mastiin urutannyamisal begini
itu kan dibatasin maks objek yang bisa dipegang 4 misal sekarang kondisinya sizenya udah 3 trus thread 1 baca size sekarang 3 thread 2 juga baca size skg 3 jd wkt thread 1 ngecek size >= maxSize masih belum memenuhi jadi ia menuju this.list.add(0, o) buat masukin objek ke stacknah thread 2, karena waktu baca size td jg masih 3, maka ia ngecek size >= maxSize jg masih belum memenuhi jadi ia menuju this.list.add(0, o) buat masukin objek ke stack, padahal this.list.add ini udah dipanggil sama thread 1 dan udah penuh, akibat masalah karena stacknya udah penuh, ArrayIndexOutOfBoundsException solusinya harus mastiin bahwa bagian yang kritis dari objek yang sama tidak boleh interleav



Perbaiki implementasi kelas Stack di atas.



    public synchronized push(Object o){
        if (size >= maxSize) {
            return false;
        }

        this.list.add(0, o);
        this.size++;
        return true;
    }

    public synchronized  Object pop() {
        Object o;
        if (this.size == 0) {
            return null;
        }

        o = this.list.remove(0);
        this.size--;
        return o;
    }

    public synchronized  int size() {
        return this.size;
    }
