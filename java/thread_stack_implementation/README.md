example implementation stack with thread
====
A answer test of [Bukalapak][test] software engineer position.

Explaination of the code
--------

* File [Single Stack][Single] is a normal stack without thread

* File [Stack Theread_Race_Condition][race] is a stack without syncronize function and running with thread with this may got message `ArrayIndexOutOfBoundsException` because thread in race condition.
  
* File [Stack_sync_byfunction][byfunction] is a stack with synchronize function that position in every function of the code. 

* File [Stack_sync_bycode][bycode] is a stack with synchronize function that position in the code that need to be synchronize.
 
[test] : https://gist.github.com/xinuc/b34ef9fc1a078ee4b2a6
[Single]: https://github.com/satrioaw/sort_code/blob/master/java/thread_stack_implementation/SingleStack.java
[race]: https://github.com/satrioaw/sort_code/blob/master/java/thread_stack_implementation/StackThread_Race_Condition.java
[byfunction]: https://github.com/satrioaw/sort_code/blob/master/java/thread_stack_implementation/Stack_sync_byfunction.java
[bycode]: https://github.com/satrioaw/sort_code/blob/master/java/thread_stack_implementation/Stack_sync_bycode.java


Don't forget to rename file to `Stack.java` to run program.