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
    
   public synchronized boolean push(Object o){
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

	public static void main(String[] args) {
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
	}

}