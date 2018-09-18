#include <stdio.h> 
#include <stdlib.h> 
#include "CUnit/Basic.h" 
int soma(int x, int y)
return x + y;
}int init_suite(void) { 
return 0; 
} 
int clean_suite(void) { 
return 0; 
} 
void testaSoma() { 
CU_ASSERT(5 == soma(2,3)); 
 CU_ASSERT(7 == soma(4,3)); 
 CU_ASSERT(87 == soma(43,44));
} 
int main() { 
CU_pSuite pSuite = NULL; 
    if (CUE_SUCCESS != CU_initialize_registry()) 
return CU_get_error(); 
    pSuite = CU_add_suite("newcunittest", init_suite, clean_suite); 
if (NULL == pSuite) { 
CU_cleanup_registry(); 
return CU_get_error(); 
} 
if (NULL == CU_add_test(pSuite, "testaSoma", testaSoma)) { 
CU_cleanup_registry(); 
return CU_get_error(); 
} 
CU_basic_set_mode(CU_BRM_VERBOSE); 
CU_automated_run_tests(); 
CU_cleanup_registry(); 
return CU_get_error(); 
} 
