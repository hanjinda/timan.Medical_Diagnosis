package DataStructures;

import java.util.ArrayList;

public class Query {
	public ArrayList<QueryTerm> termList;
	
	public Query(){
		termList = new ArrayList<QueryTerm>();
	}
	public int termExist(QueryTerm term){
		for(int i = 0; i<termList.size(); ++i){
			QueryTerm current = termList.get(i);
			if(current.termID == term.termID)
				return i;
		}
		return -1;
	}
	public void update(QueryTerm term){
		int index = termExist(term);
		if(index >= 0){
			term.termWeight += termList.get(index).termWeight;
			termList.set(index, term);
		}
		else{
			termList.add(term);
		}
	}
}
