package DataStructures;

import java.util.ArrayList;

public class DocReference {
	public int docID;
	public String docName;
	public int docLength;
	public ArrayList<Integer> topWords;
	
	public DocReference(int docID, String docName, int docLength, ArrayList<Integer> topWords){
		this.docID = docID;
		this.docLength = docLength;
		this.topWords = topWords;
		this.docName = docName;
	}
}
