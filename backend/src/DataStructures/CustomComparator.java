package DataStructures;

import java.util.Comparator;

public class CustomComparator implements Comparator<DocScoreTuple> {
    @Override
    public int compare(DocScoreTuple i1, DocScoreTuple i2) {
        return (i1.score <= i2.score)?1:-1;
    }
}
