package DataStructures;

import java.util.ArrayList;
import java.util.HashMap;

public class InvertedIndexDic {
	public HashMap<Integer, ArrayList<DocFreqTuple>> map;
	public InvertedIndexDic(){
		map = new HashMap<Integer, ArrayList<DocFreqTuple>>();
	}
	
	public ArrayList<DocFreqTuple> getDocumentList(int termID){
		return map.get(termID);
	}
}
